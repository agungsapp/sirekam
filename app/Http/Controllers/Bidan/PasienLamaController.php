<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PasienLamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.lama.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik' => ['required', 'digits:16'],
            'no_hp' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/', 'max:13'],
            'tanggal_kunjungan' => ['required', 'date', 'after_or_equal:today'],
        ]);

        try {
            DB::beginTransaction();

            // Cari pasien berdasarkan NIK dan nomor HP
            $pasien = Pasien::where('nik', $validated['nik'])
                ->where('no_hp', $validated['no_hp'])
                ->first();

            if (!$pasien) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pasien tidak ditemukan. Pastikan NIK dan nomor HP sesuai.'
                ], 422);
            }

            // Cek jumlah pendaftar untuk tanggal yang sama
            $tanggal_kunjungan = Carbon::parse($validated['tanggal_kunjungan']);
            $jumlah_pendaftar = Pendaftaran::whereDate('tanggal_kunjungan', $tanggal_kunjungan)
                ->count();

            // Set nomor antrian (jumlah pendaftar saat ini + 1)
            $no_antrian = $jumlah_pendaftar + 1;

            // Hitung estimasi waktu kedatangan
            // Asumsi pelayanan mulai jam 08:00 pagi
            $jam_pelayanan_mulai = Carbon::parse($tanggal_kunjungan->format('Y-m-d') . ' 08:00:00');
            $estimasi_waktu = $jam_pelayanan_mulai->addHours($jumlah_pendaftar); // Tambah 1 jam per pasien

            // Simpan pendaftaran
            Pendaftaran::create([
                'id_pasien' => $pasien->id,
                'no_antrian' => $no_antrian,
                'tanggal_kunjungan' => $tanggal_kunjungan,
                'status' => 'pending'
            ]);

            DB::commit();

            // Format pesan untuk alert
            $formatted_estimasi = $estimasi_waktu->format('d M Y H:i');
            $message = "Pendaftaran berhasil! Nomor antrian Anda: {$no_antrian}. Estimasi waktu kedatangan: {$formatted_estimasi}";

            // SweetAlert dan redirect
            Alert::success('Pendaftaran Berhasil', $message);
            return redirect()->to('/home#pasien-lama')
                ->with('sent-message', $message);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Gagal menyimpan pendaftaran pasien lama: ' . $th->getMessage(), [
                'nik' => $request->nik,
                'no_hp' => $request->no_hp,
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'exception' => $th,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
