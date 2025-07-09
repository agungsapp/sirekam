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
            'nik' => ['required', 'digits:16'], // NIK harus 16 digit
            'no_hp' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/'], // Nomor HP Indonesia (08xxx, 10-13 digit)
            'tanggal_kunjungan' => ['required', 'date', 'after_or_equal:today'], // Tanggal tidak boleh di masa lalu
        ]);

        try {
            DB::beginTransaction();
            $pasien = Pasien::where('nik', $validated['nik'])
                ->where('no_hp', $validated['no_hp'])
                ->first();

            if (!$pasien) {
                return redirect()->back()
                    ->withInput()
                    ->with('error-message', 'Data pasien tidak ditemukan. Pastikan NIK dan nomor HP sesuai.');
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
                'request' => $request->all(),
                'exception' => $th,
            ]);

            return redirect()->to('/home#pasien-lama')
                ->withInput()
                ->with('error-message', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
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
