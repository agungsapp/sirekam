<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 9; $i++) {
            Gallery::create([
                'image' =>  'gallery/' . $i . '.png',
                'keterangan' => 'Generate sistem ' . $i,
            ]);
        }

        $this->copyImages();
    }

    protected function copyImages(): array
    {
        // Direktori sumber dan tujuan
        $sourceDir = public_path('seeder/gallery');
        $destinationDir = storage_path('app/public/gallery');

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
