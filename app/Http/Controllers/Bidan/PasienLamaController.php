<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

            // Periksa apakah ada pendaftaran aktif untuk pasien ini pada tanggal yang sama
            $existingPendaftaran = Pendaftaran::where('id_pasien', $pasien->id)
                ->whereDate('tanggal_kunjungan', $validated['tanggal_kunjungan'])
                ->whereIn('status', ['pending', 'menunggu', 'diperiksa', 'batal'])
                ->first();

            if ($existingPendaftaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah memiliki jadwal aktif pada tanggal ini. Harap tunggu hingga jadwal ditangani oleh bidan.'
                ], 422);
            }

            // Buat pendaftaran baru
            Pendaftaran::create([
                'id_pasien' => $pasien->id,
                'tanggal_kunjungan' => $validated['tanggal_kunjungan'],
                'status' => 'pending',
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran berhasil! Silakan tunggu konfirmasi kunjungan.'
            ], 200);
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
