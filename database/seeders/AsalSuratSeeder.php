<?php

namespace Database\Seeders;

use App\Models\AsalSurat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsalSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $asal = [
            'BIRO AUAK',
            'Bagian Kepegawaian',
            'Bagian Keuangan',
            'Bagian Umum',
            'Bagian Akademik',
            'Bagian Kehumasan',
            'Bagian Kearsipan',
            'Lainnya',

        ];

        foreach($asal as $v) {
            AsalSurat::insert([
                'nama' => $v
            ]);
        }
    }
}
