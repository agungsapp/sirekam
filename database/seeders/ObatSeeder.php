<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;
use Illuminate\Support\Facades\File;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path ke file CSV di public/seeder
        $filePath = public_path('seeder/data_obat.csv');

        // Periksa apakah file ada
        if (!File::exists($filePath)) {
            throw new \Exception('File data_obat.csv tidak ditemukan di public/seeder.');
        }

        // Baca file CSV
        $csvData = array_map('str_getcsv', file($filePath));
        array_shift($csvData); // Lewati header, langsung proses data

        $obats = [];
        foreach ($csvData as $row) {
            // Pastikan baris memiliki cukup kolom
            if (count($row) < 2) {
                continue; // Lewati baris yang tidak lengkap
            }

            // Bersihkan BOM dan spasi
            $nama = trim(str_replace("\ufeff", "", $row[0]));
            $keterangan = trim(str_replace("\ufeff", "", $row[1]));

            // Perbaiki keterangan yang kurang informatif
            if ($keterangan === $nama || empty($keterangan)) {
                $keterangan = $this->generateKeterangan($nama);
            }

            $obats[] = [
                'nama' => $nama,
                'keterangan' => $keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Masukkan data ke tabel obat
        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }

    /**
     * Generate keterangan berdasarkan nama obat jika keterangan kurang informatif.
     *
     * @param string $nama
     * @return string
     */
    private function generateKeterangan($nama)
    {
        $nama = strtolower($nama);

        if (stripos($nama, 'bio atp') !== false) {
            return 'Tablet, untuk membantu metabolisme energi dan stamina';
        } elseif (stripos($nama, 'valsartan') !== false) {
            return 'Tablet, untuk mengatasi tekanan darah tinggi';
        } elseif (stripos($nama, 'diapet') !== false) {
            return 'Kapsul, untuk mengurangi frekuensi buang air besar';
        } elseif (stripos($nama, 'ostelox') !== false) {
            return 'Tablet, untuk meredakan nyeri dan peradangan';
        }

        return 'Obat dalam bentuk tablet atau kapsul, sesuai resep dokter';
    }
}
