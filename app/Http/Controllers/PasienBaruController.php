<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PasienBaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.baru.index');
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
            'nik' => 'required|numeric|digits:16|unique:pasien,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:l,p', // Sesuai dengan nama field di form
            'tanggal_lahir' => 'required|date|before:today',
            'tanggal_kunjungan' => 'required|date',
            'no_hp' => 'required|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'alamat' => 'required|string|max:500',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'tanggal_kunjungan.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_kunjungan.date' => 'Tanggal lahir tidak valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Format nomor HP tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        try {
            // Simpan data ke tabel pasien
            $pasien = Pasien::create([
                'nik' => $validated['nik'],
                'nama' => $validated['nama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'password' => bcrypt($validated['nik']),
            ]);

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

            // Format pesan untuk alert
            $formatted_estimasi = $estimasi_waktu->format('d M Y H:i');
            $message = "Pendaftaran berhasil! Nomor antrian Anda: {$no_antrian}. Estimasi waktu kedatangan: {$formatted_estimasi}";

            // SweetAlert dan redirect
            Alert::success('Pendaftaran Berhasil', $message);
            return redirect()->to('/home#pasien-baru')->with('sent-message', $message);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Gagal menyimpan data pasien: ' . $e->getMessage());

            // Redirect kembali dengan pesan error
            return redirect()->to('/home#pasien-baru')->withInput()->with('error-message', 'Pendaftaran gagal. Silakan coba lagi.');
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
