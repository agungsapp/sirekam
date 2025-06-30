<?php

namespace App\Http\Controllers;

use App\Models\FaqModel;
use App\Models\Gallery;
use App\Models\Pendaftaran;
use App\Models\Testimoni;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        // Konfigurasi waktu rata-rata per pasien (dalam menit)
        $waktuPerPasien = config('antrian.waktu_per_pasien', 10); // Ambil dari config, default 10 menit
        $today = Carbon::today()->toDateString();

        // Ambil antrian hari ini dengan eager loading
        $antrian = Pendaftaran::with('pasien')
            ->whereDate('tanggal_kunjungan', $today)
            ->orderBy('created_at', 'asc')
            ->select('id', 'id_pasien', 'status', 'created_at', 'updated_at')
            ->get();

        // Ambil pasien yang sedang dilayani
        $sedangDilayani = Pendaftaran::where('status', 'diperiksa')
            ->select('id', 'id_pasien', 'updated_at')
            ->first();

        $estimasiSekarang = Carbon::now();
        $estimasi = [];

        // Jika ada pasien sedang dilayani, hitung sisa waktu berdasarkan updated_at
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

        foreach ($antrian as $index => $item) {
            $pasienNama = $item->pasien->nama ?? '-';

            if ($item->status === 'selesai') {
                $estimasi[] = [
                    'id' => $item->id,
                    'nama' => $pasienNama,
                    'status' => 'Selesai',
                    'estimasi' => 'Selesai',
                ];
            } elseif ($item->status === 'diperiksa') {
                $estimasi[] = [
                    'id' => $item->id,
                    'nama' => $pasienNama,
                    'status' => 'Sedang Dilayani',
                    'estimasi' => 'Sedang Dilayani',
                ];
                // Estimasi untuk pasien berikutnya dimulai setelah pasien ini selesai
                $estimasiSekarang = $estimasiSekarang->copy()->addMinutes($waktuPerPasien);
            } elseif ($item->status === 'menunggu') {
                $estimasi[] = [
                    'id' => $item->id,
                    'nama' => $pasienNama,
                    'status' => 'Menunggu',
                    'estimasi' => $estimasiSekarang->format('H:i'),
                ];
                $estimasiSekarang = $estimasiSekarang->copy()->addMinutes($waktuPerPasien);
            }
        }

        return response()->json([
            'list' => $estimasi,
            'aktif' => $sedangDilayani ? [
                'id' => $sedangDilayani->id,
                'nama' => $sedangDilayani->pasien->nama ?? '-',
                'sisa_waktu' => $sedangDilayani ? $waktuSelesaiPelayanan->diffInMinutes(Carbon::now(), false) : 0,
            ] : null,
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
