<?php

namespace Database\Seeders;

use App\Models\kd_unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KdUnit extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit = [
            [
                'kode'  => 'FTAR',
                'nomor' => '01',
                'nama'  => 'Fakultas Tarbiyah',
            ],
            [
                'kode'  => 'FSIH',
                'nomor' => '02',
                'nama'  => 'Fakultas Syariah dan Ilmu Hukum Islam',
            ],
            [
                'kode'  => 'FUAD',
                'nomor' => '03',
                'nama'  => 'Fakultas Ushuluddin, Adab dan Dakwah',
            ],
            [
                'kode'  => 'FEBI',
                'nomor' => '04',
                'nama'  => 'Fakultas Ekonomi Bisnis dan Islam',
            ],
            [
                'kode'  => 'PPS',
                'nomor' => '05',
                'nama'  => 'Pascasarjana',
            ],
            [
                'kode'  => 'LPM',
                'nomor' => '06',
                'nama'  => 'Lembaga Penjaminan Mutu',
            ],
            [
                'kode'  => 'LP2M',
                'nomor' => '07',
                'nama'  => 'Lembaga Penelitian dan Pengabdian pada Masyarakat',
            ],
            [
                'kode'  => 'SPI',
                'nomor' => '08',
                'nama'  => 'Satuan Pengawas Internal',
            ],
            [
                'kode'  => 'UPS',
                'nomor' => '09',
                'nama'  => 'Unit Pelaksana Teknis Perpustakaan',
            ],
            [
                'kode'  => 'UPB',
                'nomor' => '10',
                'nama'  => 'Unit Pelaksana Teknis Pengembangan Bahasa',
            ],
            [
                'kode'  => 'TIPD',
                'nomor' => '11',
                'nama'  => 'Unit Pelaksana Teknis Teknologi Informasi dan Pangkalan Data',
            ],
            [
                'kode'  => 'MJ',
                'nomor' => '12',
                'nama'  => "Unit Pelaksana Teknis Ma'had al-Jami'ah ",
            ],
        ];

        foreach($unit as $i => $v) {
            kd_unit::create([
                'kode'  => $v['kode'],
                'nomor'  => $v['nomor'],
                'nama'  => $v['nama'],
            ]);
        };

    }
}
