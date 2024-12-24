<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\Models\surat_masuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuratMasukExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    protected $data, $header;

    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    public function collection()
    {
        return $this->data->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'tgl_surat' => Helper::getDateIndo($item->tgl_surat),
                'Nomor' => $item->nomor,
                'perihal' => strip_tags($item->perihal),
                'status' => $item->status,
                'asal' => $item->asal,
                'tgl_terima' =>
                Helper::getDateIndo($item->tgl_terima),
                'tgl_input' =>
                Helper::getDateIndo($item->tgl_input),
                'ttd' => $item->ttd,
                'tujuan' => $item->tujuan,
                'kepada' => $item->kepada,
                'jenis' => $item->jenis,
                'nomor_box' => $item->nomor_box,
                'nomor_rak' => $item->nomor_rak,
                'Retensi' => strip_tags('<span class="fw-semibold text-nowrap">'
                    . Helper::getRentangTanggal($item->tgl, $item->retensi) . ' ( Aktif Hingga '
                    . Helper::getDateIndo($item->retensi) . ' ) <br>'
                    . Helper::getRentangTanggal($item->retensi, $item->retensi2) . ' ( Inaktif Hingga '
                    . Helper::getDateIndo($item->retensi2) . ' ) <br>'
                    . $item->retensi3 . ' ( Nasib )<br>'
                    . '</span>'),
            ];
        });
    }

    public function headings(): array
    {
        // Tambahkan judul sebagai baris pertama di dalam file Excel
        return [
            [$this->header], // Judul di baris pertama
            [], // Baris kosong untuk spasi
            ['No', 'Tanggal Surat', 'Nomor', 'Perihal', 'Status', 'Asal', 'Tanggal Terima', 'Tanggal Input', 'Ttd', 'Tujuan', 'kepada', 'Jenis', 'Nomor Box', 'Nomor Rak', 'Retensi']
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Styling untuk judul dan heading
        return [
            1    => ['font' => ['bold' => true, 'size' => 16]], // Styling judul
            3    => ['font' => ['bold' => true]], // Styling heading kolom
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event): void {
                $sheet = $event->sheet;

                // Set AutoSize untuk setiap kolom
                foreach (range('A', 'O') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Set border pada tabel
                $sheet->getStyle('A3:O' . (count($this->data) + 3))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Merge cell untuk judul
                $sheet->mergeCells('A1:O1');
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            },
        ];
    }
}
