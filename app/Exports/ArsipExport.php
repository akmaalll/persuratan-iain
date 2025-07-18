<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\Models\ArsipSurat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArsipExport implements FromCollection, WithHeadings, WithStyles, WithEvents
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
            // Parse retensi data
            $retensiAktif = Helper::getRentangTanggal($item->tgl, $item->retensi) . ' ( Aktif Hingga ' . Helper::getDateIndo($item->retensi) . ' )';
            $retensiInaktif = Helper::getRentangTanggal($item->retensi, $item->retensi2) . ' ( Inaktif Hingga ' . Helper::getDateIndo($item->retensi2) . ' )';
            $retensiNasib = $item->retensi3 . ' ( Nasib )';

            return [
                'No' => $index + 1,
                'Kode Klasifikasi' => $item->klasifikasi->nomor . ' - ' . $item->klasifikasi->nama,
                'Nomor' => $item->nomor,
                'Uraian' => strip_tags($item->uraian),
                'Retensi Aktif' => $retensiAktif,
                'Retensi Inaktif' => $retensiInaktif,
                'Retensi Nasib' => $retensiNasib,
                'Pencipta' => isset($item->cipta->nama) ? $item->cipta->nama : $item->pencipta,
                'Unit Pengolah' => isset($item->unit->nama) ? $item->unit->nama : $item->unit_pengolah,
                'Media' => $item->jenis_media,
                'Tanggal' => Helper::getDateIndo($item->tgl),
                'Keterangan' => $item->ket_keaslian,
            ];
        });
    }

    public function headings(): array
    {
        // Header dengan 2 level
        return [
            [$this->header], // Judul di baris pertama
            [], // Baris kosong untuk spasi
            // Header level 1 (merged headers)
            ['No', 'Kode Klasifikasi', 'Nomor', 'Uraian', 'Retensi', '', '', 'Pencipta', 'Unit Pengolah', 'Media', 'Tanggal', 'Keterangan'],
            // Header level 2 (sub headers)
            ['', '', '', '', 'Aktif', 'Inaktif', 'Nasib', '', '', '', '', '']
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Styling untuk judul dan heading
        return [
            1    => ['font' => ['bold' => true, 'size' => 16]], // Styling judul
            3    => ['font' => ['bold' => true]], // Styling heading level 1
            4    => ['font' => ['bold' => true]], // Styling heading level 2
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event): void {
                $sheet = $event->sheet;

                // Set AutoSize untuk setiap kolom
                foreach (range('A', 'L') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Merge cells untuk judul
                $sheet->mergeCells('A1:L1');
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                // Merge cells untuk header yang tidak memiliki sub-header
                $sheet->mergeCells('A3:A4'); // No
                $sheet->mergeCells('B3:B4'); // Kode Klasifikasi
                $sheet->mergeCells('C3:C4'); // Nomor
                $sheet->mergeCells('D3:D4'); // Uraian
                $sheet->mergeCells('E3:G3'); // Retensi (merge horizontal)
                $sheet->mergeCells('H3:H4'); // Pencipta
                $sheet->mergeCells('I3:I4'); // Unit Pengolah
                $sheet->mergeCells('J3:J4'); // Media
                $sheet->mergeCells('K3:K4'); // Tanggal
                $sheet->mergeCells('L3:L4'); // Keterangan

                // Set alignment untuk merged cells
                $sheet->getStyle('A3:L4')->getAlignment()->setHorizontal('center');
                $sheet->getStyle('A3:L4')->getAlignment()->setVertical('center');

                // Set border pada tabel (termasuk header)
                $sheet->getStyle('A3:L' . (count($this->data) + 4))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Set background color untuk header
                $sheet->getStyle('A3:L4')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFE6E6FA']
                    ]
                ]);
            },
        ];
    }
}
