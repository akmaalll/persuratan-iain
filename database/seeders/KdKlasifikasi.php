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
            ['id' => 1, 'nomor' => '00', 'nama' => 'Organisasi'],
            ['id' => 1, 'nomor' => '01', 'nama' => 'Tata Laksana'],
            ['id' => 1, 'nomor' => '01.01', 'nama' => 'Tata Laksana Perencanaan'],
            ['id' => 1, 'nomor' => '01.02', 'nama' => 'Tata Laksana Laporan'],
            ['id' => 1, 'nomor' => '01.03', 'nama' => 'Tata Laksana Penyusunan Prosedur Kerja'],
            ['id' => 1, 'nomor' => '01.04', 'nama' => 'Tata Laksana Penyusunan Pembakuan Sarana Kerja'],
            ['id' => 1, 'nomor' => '02', 'nama' => 'Keamanan'],

            // kehumasan 
            ['id' => 2, 'nomor' => '00', 'nama' => 'Penerangan'],
            ['id' => 2, 'nomor' => '01', 'nama' => 'Hubungan'],
            ['id' => 2, 'nomor' => '02', 'nama' => 'Dokumentasi dan Keputusan'],
            ['id' => 2, 'nomor' => '02.01', 'nama' => 'Dokumentasi'],
            ['id' => 2, 'nomor' => '02.02', 'nama' => 'Kepustakaan'],
            ['id' => 2, 'nomor' => '02.03', 'nama' => 'Keprotokolan'],
            ['id' => 2, 'nomor' => '02.03', 'nama' => 'Keprotokolan'],

            // Kepegawaian
            ['id' => 3, 'nomor' => '00', 'nama' => 'Pengadaan'],
            ['id' => 3, 'nomor' => '00.01', 'nama' => 'Formasi'],
            ['id' => 3, 'nomor' => '00.02', 'nama' => 'Penerimaan'],
            ['id' => 3, 'nomor' => '00.03', 'nama' => 'Pengangkatan'],
            ['id' => 3, 'nomor' => '01', 'nama' => 'Tata Usaha dan Kepegewaian'],
            ['id' => 3, 'nomor' => '01.01', 'nama' => 'Izin/Dispensasi'],
            ['id' => 3, 'nomor' => '01.02', 'nama' => 'Keterangan'],
            ['id' => 3, 'nomor' => '02', 'nama' => 'Pendidikan Latihan'],
            ['id' => 3, 'nomor' => '02.01', 'nama' => 'Diklat Prajabatan'],
            ['id' => 3, 'nomor' => '02.02', 'nama' => 'Diklat dalam Jabatan'],
            ['id' => 3, 'nomor' => '02.03', 'nama' => 'Latihan/Kursus, Penataran'],
            ['id' => 3, 'nomor' => '02.03', 'nama' => 'Latihan/Kursus, Penataran'],
            ['id' => 3, 'nomor' => '03', 'nama' => 'KOPRI'],
            ['id' => 3, 'nomor' => '04', 'nama' => 'Penilaian dan Hukuman'],
            ['id' => 3, 'nomor' => '04.01', 'nama' => 'Penilaian'],
            ['id' => 3, 'nomor' => '04.02', 'nama' => 'Hukuman'],
            ['id' => 3, 'nomor' => '05', 'nama' => 'Screening'],
            ['id' => 3, 'nomor' => '06', 'nama' => 'Pembinaan Mental'],
            ['id' => 3, 'nomor' => '07', 'nama' => 'Mutasi'],
            ['id' => 3, 'nomor' => '07.01', 'nama' => 'Kepangkatan'],
            ['id' => 3, 'nomor' => '07.02', 'nama' => 'Kenaikan Berkala'],
            ['id' => 3, 'nomor' => '07.03', 'nama' => 'Penyesuaian Masa Kerja'],
            ['id' => 3, 'nomor' => '07.04', 'nama' => 'Penyesuaian Tunjangan Keluarga'],
            ['id' => 3, 'nomor' => '07.05', 'nama' => 'Alih Tugas'],
            ['id' => 3, 'nomor' => '07.06', 'nama' => 'Jabatan Strukturan/Fungsional'],
            ['id' => 3, 'nomor' => '08', 'nama' => 'Kesejahteraan'],
            ['id' => 3, 'nomor' => '08.01', 'nama' => 'Kesehatan'],
            ['id' => 3, 'nomor' => '08.02', 'nama' => 'Cuti'],
            ['id' => 3, 'nomor' => '08.03', 'nama' => 'Rekreasi'],
            ['id' => 3, 'nomor' => '08.04', 'nama' => 'Bantuan Sosial'],
            ['id' => 3, 'nomor' => '08.05', 'nama' => 'Koperasi'],
            ['id' => 3, 'nomor' => '08.06', 'nama' => 'Perumahan'],
            ['id' => 3, 'nomor' => '08.07', 'nama' => 'Antar Jemput'],
            ['id' => 3, 'nomor' => '08.08', 'nama' => 'Penghargaan'],
            ['id' => 3, 'nomor' => '09', 'nama' => 'Pemutusan Hubugan Kerja'],

            // Keuangan
            ['id' => 4, 'nomor' => '00', 'nama' => 'Anggaran'],
            ['id' => 4, 'nomor' => '00.01', 'nama' => 'Rutin'],
            ['id' => 4, 'nomor' => '00.02', 'nama' => 'Pembangunan'],
            ['id' => 4, 'nomor' => '00.03', 'nama' => 'Nonbudgetter'],
            ['id' => 4, 'nomor' => '01', 'nama' => 'Surat Permintaan Pembayaran (SPP)'],
            ['id' => 4, 'nomor' => '01.01', 'nama' => 'SPP Beban Tetap dan Semetara Rutin'],
            ['id' => 4, 'nomor' => '01.02', 'nama' => 'SPP Beban Tetap dan Sementarar Pembangunan'],
            ['id' => 4, 'nomor' => '02', 'nama' => 'Surat Pertanggung Jawaban (SPJ) Rutin/Pembangunan'],
            ['id' => 4, 'nomor' => '02.01', 'nama' => 'SPJ Rutin'],
            ['id' => 4, 'nomor' => '02.02', 'nama' => 'SPJ Pembangunan'],
            ['id' => 4, 'nomor' => '03', 'nama' => 'Pendapatan Negara'],
            ['id' => 4, 'nomor' => '03.01', 'nama' => 'Pajak'],
            ['id' => 4, 'nomor' => '03.02', 'nama' => 'Bukan Pajak'],
            ['id' => 4, 'nomor' => '04', 'nama' => 'Perbankan'],
            ['id' => 4, 'nomor' => '04.01', 'nama' => 'Valuta Asing/Transfer'],
            ['id' => 4, 'nomor' => '04.02', 'nama' => 'Saldo Rekening'],
            ['id' => 4, 'nomor' => '05', 'nama' => 'Sumbangan/Bantuan'],

            // Kesekretarian
            ['id' => 5, 'nomor' => '00', 'nama' => 'Kerumahtanggaan'],
            ['id' => 5, 'nomor' => '00.01', 'nama' => 'Perlengkapan'],
            ['id' => 5, 'nomor' => '00.02', 'nama' => 'Gedung'],
            ['id' => 5, 'nomor' => '00.03', 'nama' => 'Alat Kantor'],
            ['id' => 5, 'nomor' => '00.04', 'nama' => 'Mesin Kantor/Alat Elektronik'],
            ['id' => 5, 'nomor' => '00.05', 'nama' => 'Perabot Kantor'],
            ['id' => 5, 'nomor' => '00.06', 'nama' => 'Kendaraan'],
            ['id' => 5, 'nomor' => '00.07', 'nama' => 'Inventaris Perlengkapan'],
            ['id' => 5, 'nomor' => '01', 'nama' => 'Ketataushaan'],

            // Hukum
            ['id' => 6, 'nomor' => '00', 'nama' => 'Peratuan Perundang-undangan'],
            ['id' => 6, 'nomor' => '00.01', 'nama' => 'Undang-Undang termasuk PERPU'],
            ['id' => 6, 'nomor' => '00.02', 'nama' => 'Peraturan Pemerintah'],
            ['id' => 6, 'nomor' => '00.03', 'nama' => 'Keputusan Presiden, Instruksi Presiden'],
            ['id' => 6, 'nomor' => '00.04', 'nama' => 'Peratuan Menteri, Instruksi Mentri'],
            ['id' => 6, 'nomor' => '00.05', 'nama' => 'Keputusan Menteri, Pimpinan Unit Eselon I, II'],
            ['id' => 6, 'nomor' => '00.06', 'nama' => 'SKB Menteri-Menteri/Pimpinan Unit Eselon I, II'],
            ['id' => 6, 'nomor' => '00.07', 'nama' => 'Edaran Menteri/Pimpinan Unit Eselon I, II'],
            ['id' => 6, 'nomor' => '00.08', 'nama' => 'Peraturan Kanwil/Kankemenag'],
            ['id' => 6, 'nomor' => '00.09', 'nama' => 'Peraturan PEMDA'],
            ['id' => 6, 'nomor' => '01', 'nama' => 'Pidana'],
            ['id' => 6, 'nomor' => '01.01', 'nama' => 'Pencurian'],
            ['id' => 6, 'nomor' => '01.02', 'nama' => 'Korupsi'],
            ['id' => 6, 'nomor' => '02', 'nama' => 'Perdata'],
            ['id' => 6, 'nomor' => '02.01', 'nama' => 'Perikatan'],
            ['id' => 6, 'nomor' => '03', 'nama' => 'Hukum Agama'],
            ['id' => 6, 'nomor' => '03.01', 'nama' => 'Fatwa'],
            ['id' => 6, 'nomor' => '03.02', 'nama' => 'Rukyat/Hisab'],
            ['id' => 6, 'nomor' => '03.03', 'nama' => 'Hari Besar Islam'],
            ['id' => 6, 'nomor' => '04', 'nama' => 'Bantuan Hukum'],
            ['id' => 6, 'nomor' => '04.01', 'nama' => 'Kasus Hukum Pidana'],
            ['id' => 6, 'nomor' => '04.02', 'nama' => 'Kasus Hukum Perdata'],
            ['id' => 6, 'nomor' => '04.03', 'nama' => 'Penelahan Hukum'],

            //  Pendidikan dan Pengajaran
            ['id' => 7, 'nomor' => '00', 'nama' => 'Kurikulum'],
            ['id' => 7, 'nomor' => '00.09', 'nama' => 'Perguruan Tinggi Agama'],
            ['id' => 7, 'nomor' => '00.10', 'nama' => 'Perguruan Tinggi Umum'],
            ['id' => 7, 'nomor' => '00.11', 'nama' => 'Pengembangan Sarjana Pendidikan'],
            ['id' => 7, 'nomor' => '01', 'nama' => 'Evaluasi dan Ijazah'],
            ['id' => 7, 'nomor' => '01.01', 'nama' => 'Perguruan Agama'],
            ['id' => 7, 'nomor' => '01.02', 'nama' => 'Perguruan Umum'],
            ['id' => 7, 'nomor' => '02', 'nama' => 'Pembinaan'],
            ['id' => 7, 'nomor' => '02.01', 'nama' => 'Pembinaan'],
            ['id' => 7, 'nomor' => '03', 'nama' => 'Kelembagaan'],
            ['id' => 7, 'nomor' => '03.01', 'nama' => 'Organisasi (Ekstrakurikuler)'],
            ['id' => 7, 'nomor' => '04', 'nama' => 'Beasiswa'],
            ['id' => 7, 'nomor' => '05', 'nama' => 'Sumbangan'],
            ['id' => 7, 'nomor' => '06', 'nama' => 'Pengabdian'],
            ['id' => 7, 'nomor' => '07', 'nama' => 'Perizinan'],

            // pengawasan
            ['id' => 8, 'nomor' => '00', 'nama' => 'Pengawasan Administrasi Umum'],
            ['id' => 8, 'nomor' => '01', 'nama' => 'Tugas Umum'],
            ['id' => 8, 'nomor' => '02', 'nama' => 'Proyek Pembangunan'],
            ['id' => 8, 'nomor' => '02.01', 'nama' => 'Fisik'],
            ['id' => 8, 'nomor' => '02.02', 'nama' => 'Nonfisik'],


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
