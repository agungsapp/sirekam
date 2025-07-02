<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class PasienPendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan lokal Indonesia untuk data realistis

        // Array nama perempuan Indonesia untuk konteks bidan
        $namaPerempuan = [
            'Siti Aminah',
            'Dewi Lestari',
            'Rina Susanti',
            'Anjani Pratiwi',
        ];

        // Array alamat dummy
        $alamat = [
            'Jl. Mawar No. 12, Jakarta Selatan',
            'Jl. Kenanga No. 5, Bandung',
            'Jl. Melati No. 8, Surabaya',
            'Jl. Anggrek No. 3, Yogyakarta',
        ];

        // Array status untuk simulasi antrian
        $statusAntrian = ['pending', 'pending', 'pending', 'pending'];

        // Tanggal hari ini
        $today = Carbon::today()->toDateString();

        // Loop untuk membuat 4 pasien
        for ($i = 0; $i < 4; $i++) {
            // Generate NIK unik (16 digit)
            $nik = $faker->unique()->numerify('32##############'); // Awalan '32' untuk Jawa Barat

            // Tanggal lahir random (usia 20-40 tahun)
            $tanggalLahir = $faker->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d');

            // Format password dari tanggal lahir (contoh: 20-05-1990 jadi 20051990)
            $passwordRaw = date('dmY', strtotime($tanggalLahir));

            // Buat data pasien
            $pasien = Pasien::create([
                'nik' => $nik,
                'nama' => $namaPerempuan[$i],
                'jenis_kelamin' => 'p', // Perempuan
                'tanggal_lahir' => $tanggalLahir,
                'no_hp' => $faker->numerify('0812#######'), // Nomor HP Indonesia
                'alamat' => $alamat[$i],
                'password' => Hash::make($passwordRaw), // Simpan hash password
            ]);

            // Buat data pendaftaran untuk hari ini
            $pendaftaran = Pendaftaran::create([
                'id_pasien' => $pasien->id,
                'tanggal_kunjungan' => $today, // Selalu hari ini
                'status' => $statusAntrian[$i], // Status bervariasi untuk simulasi
                'created_at' => Carbon::now()->subMinutes(30 - $i * 10), // Simulasi urutan antrian
                'updated_at' => $statusAntrian[$i] === 'diperiksa' ? Carbon::now()->subMinutes(2) : Carbon::now(),
            ]);

            // Untuk cek di console
            $this->command->info("Pasien {$pasien->nama} | NIK: {$nik} | Password: {$passwordRaw} | Status: {$pendaftaran->status}");
        }
    }
}
