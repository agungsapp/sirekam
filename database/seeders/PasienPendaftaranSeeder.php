<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        ];

        // Array alamat dummy
        $alamat = [
            'Jl. Mawar No. 12, Jakarta Selatan',
            'Jl. Kenanga No. 5, Bandung',
            'Jl. Melati No. 8, Surabaya',
        ];

        // Loop untuk membuat 3 pasien
        for ($i = 0; $i < 3; $i++) {
            // Generate NIK unik (16 digit)
            $nik = $faker->unique()->numerify('32##############'); // Awalan '32' untuk contoh Jawa Barat

            // Buat data pasien
            $pasien = Pasien::create([
                'nik' => $nik,
                'nama' => $namaPerempuan[$i],
                'jenis_kelamin' => 'p', // Perempuan
                'tanggal_lahir' => $faker->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d'), // Usia 20-40 tahun
                'no_hp' => $faker->numerify('0812#######'), // Nomor HP Indonesia
                'alamat' => $alamat[$i],
            ]);

            // Buat data pendaftaran
            Pendaftaran::create([
                'id_pasien' => $pasien->id,
                'tanggal_kunjungan' => $faker->dateTimeBetween('now', '+7 days')->format('Y-m-d'), // Kunjungan dalam 7 hari
                'status' => 'menunggu',
            ]);
        }
    }
}
