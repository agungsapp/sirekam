<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimoni::create([
            'nama' => 'Budi Santoso',
            'pekerjaan' => 'Pegawai Swasta',
            'testimoni' => 'Pelayanan klinik sangat baik, dokter dan bidan sangat ramah dan profesional.',
            'image' => '/testimoni/default.jpg',
            'rating' => '5',
            'status' => 'active',
        ]);

        Testimoni::create([
            'nama' => 'Siti Aminah',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'testimoni' => 'Fasilitas klinik bersih, tetapi waktu tunggu agak lama pada jam sibuk.',
            'image' => '/testimoni/default.jpg',
            'rating' => '3',
            'status' => 'active',
        ]);

        Testimoni::create([
            'nama' => 'Ahmad Fauzi',
            'pekerjaan' => 'Wirausaha',
            'testimoni' => 'Pengalaman berobat sangat memuaskan, staf klinik sangat membantu.',
            'image' => '/testimoni/default.jpg',
            'rating' => '4',
            'status' => 'inactive',
        ]);

        Testimoni::create([
            'nama' => 'Rina Wulandari',
            'pekerjaan' => 'Guru',
            'testimoni' => 'Klinik ini sangat peduli dengan pasien, terutama untuk ibu hamil.',
            'image' => 'testimoni/default.jpg',
            'rating' => '5',
            'status' => 'active',
        ]);

        $this->copyImages();
    }

    protected function copyImages(): array
    {
        // Direktori sumber dan tujuan
        $sourceDir = public_path('seeder/testimoni');
        $destinationDir = storage_path('app/public/testimoni');

        // Buat direktori tujuan jika belum ada
        if (!File::exists($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true);
        }

        // Ambil semua file dari direktori sumber
        $files = File::files($sourceDir);
        $copiedImages = [];

        // Salin setiap file ke direktori tujuan
        foreach ($files as $file) {
            // Hanya salin file gambar (jpg, jpeg, png, gif)
            if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $filename = $file->getFilename();
                $sourcePath = $file->getPathname();
                $destinationPath = $destinationDir . '/' . $filename;

                File::copy($sourcePath, $destinationPath);
                $copiedImages[] = $filename;

                // Log untuk debugging
                Log::info("Copied image: $filename to $destinationPath");
            }
        }

        return $copiedImages;
    }
}
