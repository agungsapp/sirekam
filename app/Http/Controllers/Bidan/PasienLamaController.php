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

            Pendaftaran::create([
                'id_pasien' => $pasien->id,
                'tanggal_kunjungan' => $validated['tanggal_kunjungan'],
                'status' => 'menunggu',
            ]);

            DB::commit();

            return redirect()->to('/home#pasien-lama')
                ->with('sent-message', 'Pendaftaran berhasil! Silakan tunggu konfirmasi kunjungan.');
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
