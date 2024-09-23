<?php

namespace Database\Seeders;

use App\Models\JenisKlasifikasi as ModelsJenisKlasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKlasifikasi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            ['OT', 'Organisasi dan Tata Laksana'],
            ['HM', 'Kehumasan'],
            ['KP', 'Kepegawaian'],
            ['KU', 'Keuangan'],
            ['KS', 'Kesekretariatan'],
            ['HK', 'Hukum'],
            ['PP', 'Pendidikan dan Pengajaran'],
            ['PS', 'Pengawasan'],
        ];

        foreach ($jenis as $i => $v) {
            ModelsJenisKlasifikasi::create([
                'kode' => $v[0],
                'nama' => $v[1],
            ]);
        }
    }
}
