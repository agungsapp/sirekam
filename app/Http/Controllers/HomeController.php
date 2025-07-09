<?php

namespace App\Http\Controllers;

use App\Models\FaqModel;
use App\Models\Gallery;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Testimoni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $pendaftarQuery = Pendaftaran::query();

        $data = [
            'gallery' => Gallery::all(),
            'faq' => FaqModel::all(),
            'testimoni' => Testimoni::where('status', 'active')->get(),
            'pendaftar' => [
                'menunggu' => $pendaftarQuery->where('status', 'menunggu')->count(),
                'diperiksa' => Pendaftaran::where('status', 'diperiksa')->count(),
                'selesai' => Pendaftaran::where('status', 'selesai')->count(),
            ],
            // 'daftarAntrian' => Pendaftaran::with('pasien')
            //     ->whereDate('tanggal_kunjungan', today())
            //     ->orderBy('created_at', 'asc')
            //     ->get(),
            // 'antrianAktif' => Pendaftaran::where('status', 'diperiksa')->first()->id
        ];

        return view('pasien.home.index', $data);
    }

    public function antrian()
    {
        // Konfigurasi waktu rata-rata per pasien (1 jam = 60 menit)
        $waktuPerPasien = 60; // Diubah menjadi 60 menit sesuai aturan 1 jam per pasien
        $today = Carbon::today()->toDateString();

        // Ambil antrian hari ini dengan eager loading, pastikan urut berdasarkan no_antrian (numeric)
        $antrian = Pendaftaran::with(['pasien'])
            ->whereDate('tanggal_kunjungan', $today)
            ->orderByRaw('CAST(no_antrian AS UNSIGNED) ASC')
            ->select('id', 'no_antrian', 'id_pasien', 'status', 'created_at', 'updated_at')
            ->get();

        // Ambil pasien yang sedang dilayani
        $sedangDilayani = Pendaftaran::with('pasien')
            ->where('status', 'diperiksa')
            ->whereDate('tanggal_kunjungan', $today)
            ->select('id', 'no_antrian', 'id_pasien', 'updated_at')
            ->first();

        // Asumsi pelayanan mulai jam 08:00 pagi
        $estimasiSekarang = Carbon::parse($today . ' 08:00:00');

        // Jika ada pasien sedang dilayani, sesuaikan estimasi waktu
        if ($sedangDilayani) {
            $waktuMulaiPelayanan = Carbon::parse($sedangDilayani->updated_at);
            $waktuSelesaiPelayanan = $waktuMulaiPelayanan->copy()->addMinutes($waktuPerPasien);

            // Jika waktu selesai pelayanan sudah lewat, gunakan waktu sekarang
            if ($waktuSelesaiPelayanan->isPast()) {
                $estimasiSekarang = Carbon::now();
            } else {
                $estimasiSekarang = $waktuSelesaiPelayanan;
            }
        }

        $estimasi = [];

        foreach ($antrian as $index => $item) {
            $pasienNama = $item->pasien->nama ?? '-';
            $noAntrian = $item->no_antrian ?? '-';

            if ($item->status === 'selesai') {
                $estimasi[] = [
                    'id' => $item->id,
                    'nama' => $pasienNama,
                    'no_antrian' => $noAntrian,
                    'status' => 'Selesai',
                    'estimasi' => 'Selesai',
                ];
            } elseif ($item->status === 'diperiksa') {
                $estimasi[] = [
                    'id' => $item->id,
                    'nama' => $pasienNama,
                    'no_antrian' => $noAntrian,
                    'status' => 'Sedang Dilayani',
                    'estimasi' => 'Sedang Dilayani',
                ];
                // Estimasi untuk pasien berikutnya dimulai setelah pasien ini selesai
                $estimasiSekarang = $estimasiSekarang->copy()->addMinutes($waktuPerPasien);
            } elseif ($item->status === 'pending') {
                $estimasi[] = [
                    'id' => $item->id,
                    'nama' => $pasienNama,
                    'no_antrian' => $noAntrian,
                    'status' => 'Antrian',
                    'estimasi' => $estimasiSekarang->format('H:i'),
                ];
                $estimasiSekarang = $estimasiSekarang->copy()->addMinutes($waktuPerPasien);
            } elseif ($item->status === 'batal') {
                $estimasi[] = [
                    'id' => $item->id,
                    'nama' => $pasienNama,
                    'no_antrian' => $noAntrian,
                    'status' => 'Batal',
                    'estimasi' => 'Batal',
                ];
            }
        }

        return response()->json([
            'list' => $estimasi,
            'aktif' => $sedangDilayani ? [
                'id' => $sedangDilayani->id,
                'no_antrian' => $sedangDilayani->no_antrian ?? '-',
                'nama' => $sedangDilayani->pasien->nama ?? '-',
                'sisa_waktu' => isset($waktuSelesaiPelayanan) ? $waktuSelesaiPelayanan->diffInMinutes(Carbon::now(), false) : 0,
            ] : null,
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function dataRekam($idPasien)
    {
        try {
            $pasien = Pasien::select('id', 'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'no_hp', 'alamat', 'created_at')
                ->with(['pendaftaran' => function ($q) {
                    $q->select('id', 'id_pasien', 'tanggal_kunjungan', 'status')
                        ->with([
                            'awal' => fn($q) => $q->select('id', 'id_pendaftaran', 'tanggal_periksa', 'tekanan_darah', 'berat_badan', 'tinggi_badan', 'keluhan'),
                            'lanjut' => fn($q) => $q->select('id', 'id_pendaftaran', 'diagnosa', 'tindakan', 'id_ruang_bersalin')
                                ->with(['resep' => fn($q) => $q->select('id', 'id_lanjut', 'id_obat', 'aturan')->with(['obat' => fn($q) => $q->select('id', 'nama')])])
                        ])
                        ->latest()
                        ->take(3); // Batasi 3 pendaftaran
                }])
                ->findOrFail($idPasien);

            return view('pasien.rekam_medis.data_rekam', compact('pasien'));
        } catch (\Exception $e) {
            throw $e;
            Log::error('Gagal memuat detail pasien: ' . $e->getMessage(), [
                'pasien_id' => $idPasien,
                'exception' => $e,
            ]);
            return redirect()->route('bidan.dashboard')->with('error-message', 'Gagal memuat data pasien. Silakan coba lagi.');
        }
    }
}
