<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'petugas',
            'email' => 'admin@gmail.com',
            'nip' => '123456789',
            'no_hp' => '123456789',
            'image' => 'profile/default.jpg',
            'password' => Hash::make('admin123'),


        ]);

        $this->call(PasienPendaftaranSeeder::class);
        $this->call(RuangBersalinSeeder::class);
        $this->call(ObatSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(TestimoniSeeder::class);
        $this->copyImages();
    }

    protected function copyImages(): array
    {
        // Direktori sumber dan tujuan
        $sourceDir = public_path('seeder/profile');
        $destinationDir = storage_path('app/public/profile');

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
