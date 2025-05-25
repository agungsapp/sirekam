<?php

namespace Database\Seeders;

use App\Models\FaqModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'question' => 'Bagaimana cara mendaftar sebagai pasien?',
                'answer' => 'Anda memiliki 2 pilihan untuk mendaftar sebagai pasien: (1) Melalui website dengan memilih opsi pasien baru atau pasien lama pada halaman pendaftaran, atau (2) Datang langsung ke klinik untuk pendaftaran tatap muka. Pastikan membawa dokumen identitas yang diperlukan.',
            ],
            [
                'question' => 'Apakah saya bisa melihat data riwayat pemeriksaan saya secara online?',
                'answer' => 'Untuk menjaga kerahasiaan dan keamanan data medis, akses ke data pasien dibatasi dan hanya tersedia melalui konsultasi langsung dengan petugas medis di klinik.',
            ],
            [
                'question' => 'Apa saja yang perlu saya siapkan untuk pendaftaran?',
                'answer' => 'Untuk pendaftaran, baik online maupun langsung, siapkan: (1) Kartu identitas (KTP/SIM/Paspor), (2) Kartu keluarga, (3) Nomor telepon aktif, dan (4) Alamat email aktif jika mendaftar online.',
            ],
            [
                'question' => 'Berapa lama proses pendaftaran pasien baru?',
                'answer' => 'Proses pendaftaran online memakan waktu sekitar 5 menit untuk mengisi formulir. Untuk pendaftaran langsung di klinik, prosesnya memakan waktu 15 menit tergantung kelengkapan dokumen.',
            ],
            [
                'question' => 'Bagaimana jika saya lupa nomor rekam medis saya?',
                'answer' => 'Jika Anda lupa nomor rekam medis, Anda dapat menghubungi petugas klinik dengan membawa KTP untuk verifikasi identitas. Untuk keamanan, informasi ini tidak dapat diakses melalui sistem online.',
            ],
        ];

        foreach ($data as $faq) {
            FaqModel::create($faq);
        }
    }
}
