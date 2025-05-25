<?php

namespace Database\Seeders;

use App\Models\RuangBersalin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuangBersalinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            RuangBersalin::create([
                'nama' => 'Ruang C' . $i + 1,
                'keterangan' => 'sistem',
            ]);
        }
    }
}
