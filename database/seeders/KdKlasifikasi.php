<?php

namespace Database\Seeders;

use App\Models\kd_klasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KdKlasifikasi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klasifikasi = [
            // organisasi dan tata laksana
            // ['id' => 1, 'nomor' => '00', 'nama' => 'Organisasi'],
            // ['id' => 1, 'nomor' => '01', 'nama' => 'Tata Laksana'],
            ['id' => 1, 'nomor' => '01.1', 'nama' => 'Perencanaan'],
            ['id' => 1, 'nomor' => '01.2', 'nama' => 'Laporan'],
            ['id' => 1, 'nomor' => '01.3', 'nama' => 'Penyusunan Prosedur Kerja'],
            ['id' => 1, 'nomor' => '01.4', 'nama' => 'Penyusunan Pembakuan Sarana Kerja'],
            ['id' => 1, 'nomor' => '02', 'nama' => 'Tingkat Keamanan'],

            // kehumasan 
            ['id' => 2, 'nomor' => '00', 'nama' => 'Penerangan'],
            ['id' => 2, 'nomor' => '01', 'nama' => 'Hubungan'],
            ['id' => 2, 'nomor' => '02', 'nama' => 'Dokumentasi dan Keputusan'],
            ['id' => 2, 'nomor' => '02.1', 'nama' => 'Dokumentasi'],
            ['id' => 2, 'nomor' => '02.2', 'nama' => 'Kepustakaan'],
            ['id' => 2, 'nomor' => '02.3', 'nama' => 'Keprotokolan'],

            // Kepegawaian
            ['id' => 3, 'nomor' => '00', 'nama' => 'Pengadaan'],
            ['id' => 3, 'nomor' => '00.1', 'nama' => 'Formasi'],
            ['id' => 3, 'nomor' => '00.2', 'nama' => 'Penerimaan'],
            ['id' => 3, 'nomor' => '00.3', 'nama' => 'Pengangkatan'],
            ['id' => 3, 'nomor' => '01', 'nama' => 'Tata Usaha Kepegewaian'],
            ['id' => 3, 'nomor' => '01.1', 'nama' => 'Izin/Dispensasi'],
            ['id' => 3, 'nomor' => '01.2', 'nama' => 'Keterangan'],
            ['id' => 3, 'nomor' => '02', 'nama' => 'Pendidikan Latihan'],
            ['id' => 3, 'nomor' => '02.1', 'nama' => 'Diklat Prajabatan'],
            ['id' => 3, 'nomor' => '02.2', 'nama' => 'Diklat dalam Jabatan'],
            ['id' => 3, 'nomor' => '02.3', 'nama' => 'Latihan/Kursus, Penataran'],
            ['id' => 3, 'nomor' => '03', 'nama' => 'KOPRRI'],
            ['id' => 3, 'nomor' => '04', 'nama' => 'Penilaian dan Hukuman'],
            ['id' => 3, 'nomor' => '04.1', 'nama' => 'Penilaian'],
            ['id' => 3, 'nomor' => '04.2', 'nama' => 'Hukuman'],
            ['id' => 3, 'nomor' => '05', 'nama' => 'Screening'],
            ['id' => 3, 'nomor' => '06', 'nama' => 'Pembinaan Mental'],
            ['id' => 3, 'nomor' => '07', 'nama' => 'Mutasi'],
            ['id' => 3, 'nomor' => '07.1', 'nama' => 'Kepangkatan'],
            ['id' => 3, 'nomor' => '07.2', 'nama' => 'Kenaikan Berkala'],
            ['id' => 3, 'nomor' => '07.3', 'nama' => 'Penyesuaian Masa Kerja'],
            ['id' => 3, 'nomor' => '07.4', 'nama' => 'Penyesuaian Tunjangan Keluarga'],
            ['id' => 3, 'nomor' => '07.5', 'nama' => 'Alih Tugas'],
            ['id' => 3, 'nomor' => '07.6', 'nama' => 'Jabatan Struktural/Fungsional'],
            ['id' => 3, 'nomor' => '08', 'nama' => 'Kesejahteraan'],
            ['id' => 3, 'nomor' => '08.1', 'nama' => 'Kesehatan'],
            ['id' => 3, 'nomor' => '08.2', 'nama' => 'Cuti'],
            ['id' => 3, 'nomor' => '08.3', 'nama' => 'Rekreasi'],
            ['id' => 3, 'nomor' => '08.4', 'nama' => 'Bantuan Sosial'],
            ['id' => 3, 'nomor' => '08.5', 'nama' => 'Koperasi'],
            ['id' => 3, 'nomor' => '08.6', 'nama' => 'Perumahan'],
            ['id' => 3, 'nomor' => '08.7', 'nama' => 'Antar Jemput'],
            ['id' => 3, 'nomor' => '08.8', 'nama' => 'Penghargaan'],
            ['id' => 3, 'nomor' => '09', 'nama' => 'Pemutusan Hubugan Kerja'],

            // Keuangan
            ['id' => 4, 'nomor' => '00', 'nama' => 'Anggaran'],
            ['id' => 4, 'nomor' => '00.1', 'nama' => 'Rutin'],
            ['id' => 4, 'nomor' => '00.2', 'nama' => 'Pembangunan'],
            ['id' => 4, 'nomor' => '00.3', 'nama' => 'Nonbudgetter'],
            ['id' => 4, 'nomor' => '01', 'nama' => 'Surat Permintaan Pembayaran (SPP)'],
            ['id' => 4, 'nomor' => '01.1', 'nama' => 'SPP Beban Tetap dan Semetara Rutin'],
            ['id' => 4, 'nomor' => '01.2', 'nama' => 'SPP Beban Tetap dan Sementarar Pembangunan'],
            ['id' => 4, 'nomor' => '02', 'nama' => 'Surat Pertanggung Jawaban (SPJ) Rutin/Pembangunan'],
            ['id' => 4, 'nomor' => '02.1', 'nama' => 'SPJ Rutin'],
            ['id' => 4, 'nomor' => '02.2', 'nama' => 'SPJ Pembangunan'],
            ['id' => 4, 'nomor' => '03', 'nama' => 'Pendapatan Negara'],
            ['id' => 4, 'nomor' => '03.1', 'nama' => 'Pajak'],
            ['id' => 4, 'nomor' => '03.2', 'nama' => 'Bukan Pajak'],
            ['id' => 4, 'nomor' => '04', 'nama' => 'Perbankan'],
            ['id' => 4, 'nomor' => '04.1', 'nama' => 'Valuta Asing/Transfer'],
            ['id' => 4, 'nomor' => '04.2', 'nama' => 'Saldo Rekening'],
            ['id' => 4, 'nomor' => '05', 'nama' => 'Sumbangan/Bantuan'],

            // Kesekretarian
            ['id' => 5, 'nomor' => '00', 'nama' => 'Kerumahtanggaan'],
            ['id' => 5, 'nomor' => '00.1', 'nama' => 'Perlengkapan'],
            ['id' => 5, 'nomor' => '00.2', 'nama' => 'Gedung'],
            ['id' => 5, 'nomor' => '00.3', 'nama' => 'Alat Kantor'],
            ['id' => 5, 'nomor' => '00.4', 'nama' => 'Mesin Kantor/Alat Elektronik'],
            ['id' => 5, 'nomor' => '00.5', 'nama' => 'Perabot Kantor'],
            ['id' => 5, 'nomor' => '00.6', 'nama' => 'Kendaraan'],
            ['id' => 5, 'nomor' => '00.7', 'nama' => 'Inventaris Perlengkapan'],
            ['id' => 5, 'nomor' => '00.8', 'nama' => 'Penawaran Umum'],
            ['id' => 5, 'nomor' => '01', 'nama' => 'Ketataushaan'],

            // Hukum
            ['id' => 6, 'nomor' => '00', 'nama' => 'Peratuan Perundang-undangan'],
            ['id' => 6, 'nomor' => '00.1', 'nama' => 'Undang-Undang termasuk PERPU'],
            ['id' => 6, 'nomor' => '00.2', 'nama' => 'Peraturan Pemerintah'],
            ['id' => 6, 'nomor' => '00.3', 'nama' => 'Keputusan Presiden, Instruksi Presiden'],
            ['id' => 6, 'nomor' => '00.4', 'nama' => 'Peratuan Menteri, Instruksi Menteri'],
            ['id' => 6, 'nomor' => '00.5', 'nama' => 'Keputusan Menteri, Pimpinan Unit Eselon I, II'],
            ['id' => 6, 'nomor' => '00.6', 'nama' => 'SKB Menteri-Menteri/Pimpinan Unit Eselon I, II'],
            ['id' => 6, 'nomor' => '00.7', 'nama' => 'Edaran Menteri/Pimpinan Unit Eselon I, II'],
            ['id' => 6, 'nomor' => '00.8', 'nama' => 'Peraturan Kanwil/Kankemenag'],
            ['id' => 6, 'nomor' => '00.9', 'nama' => 'Peraturan PEMDA'],
            ['id' => 6, 'nomor' => '01', 'nama' => 'Pidana'],
            ['id' => 6, 'nomor' => '01.1', 'nama' => 'Pencurian'],
            ['id' => 6, 'nomor' => '01.2', 'nama' => 'Korupsi'],
            ['id' => 6, 'nomor' => '02', 'nama' => 'Perdata'],
            ['id' => 6, 'nomor' => '02.1', 'nama' => 'Perikatan'],
            ['id' => 6, 'nomor' => '03', 'nama' => 'Hukum Agama'],
            ['id' => 6, 'nomor' => '03.1', 'nama' => 'Fatwa'],
            ['id' => 6, 'nomor' => '03.2', 'nama' => 'Rukyat/Hisab'],
            ['id' => 6, 'nomor' => '03.3', 'nama' => 'Hari Besar Islam'],
            ['id' => 6, 'nomor' => '04', 'nama' => 'Bantuan Hukum'],
            ['id' => 6, 'nomor' => '04.1', 'nama' => 'Kasus Hukum Pidana'],
            ['id' => 6, 'nomor' => '04.2', 'nama' => 'Kasus Hukum Perdata'],
            ['id' => 6, 'nomor' => '04.3', 'nama' => 'Penelaahan Hukum'],

            //  Pendidikan dan Pengajaran
            ['id' => 7, 'nomor' => '00', 'nama' => 'Kurikulum'],
            ['id' => 7, 'nomor' => '00.9', 'nama' => 'Perguruan Tinggi Agama'],
            ['id' => 7, 'nomor' => '00.10', 'nama' => 'Perguruan Tinggi Umum'],
            ['id' => 7, 'nomor' => '00.11', 'nama' => 'Pengembangan Sarjana Pendidikan'],
            ['id' => 7, 'nomor' => '01', 'nama' => 'Evaluasi dan Ijazah'],
            ['id' => 7, 'nomor' => '01.1', 'nama' => 'Perguruan Agama'],
            ['id' => 7, 'nomor' => '01.2', 'nama' => 'Perguruan Umum'],
            ['id' => 7, 'nomor' => '02', 'nama' => 'Pembinaan'],
            ['id' => 7, 'nomor' => '02.1', 'nama' => 'Pembinaan'],
            ['id' => 7, 'nomor' => '03', 'nama' => 'Kelembagaan'],
            ['id' => 7, 'nomor' => '03.1', 'nama' => 'Organisasi (Ekstra Kurikuler)'],
            ['id' => 7, 'nomor' => '04', 'nama' => 'Beasiswa'],
            ['id' => 7, 'nomor' => '05', 'nama' => 'Sumbangan'],
            ['id' => 7, 'nomor' => '06', 'nama' => 'Pengabdian'],
            ['id' => 7, 'nomor' => '07', 'nama' => 'Perizinan'],

            // pengawasan
            ['id' => 8, 'nomor' => '00', 'nama' => 'Pengawasan Administrasi Umum'],
            ['id' => 8, 'nomor' => '01', 'nama' => 'Tugas Umum'],
            ['id' => 8, 'nomor' => '02', 'nama' => 'Proyek Pembangunan'],
            ['id' => 8, 'nomor' => '02.1', 'nama' => 'Fisik'],
            ['id' => 8, 'nomor' => '02.2', 'nama' => 'Nonfisik'],


        ];

        foreach ($klasifikasi as $i => $v) {
            kd_klasifikasi::create([
                'jenis_klasifikasi_id' => $v['id'],
                'nomor' => $v['nomor'],
                'nama' => $v['nama'],
            ]);
        };
    }
}
