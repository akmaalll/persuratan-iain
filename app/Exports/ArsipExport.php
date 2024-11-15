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
            return [
                'No' => $index + 1,
                'Kode Klasifikasi' => $item->klasifikasi->nomor . ' - ' . $item->klasifikasi->nama,
                'Nomor' => $item->nomor,
                'Uraian' => strip_tags($item->uraian),
                'Retensi' => Helper::getDateIndo($item->retensi),
                'Pencipta' => $item->cipta->nama,
                'Unit Pengolah' => $item->unit->nama,
                'Media' => $item->jenis_media,
                'Tanggal' => Helper::getDateIndo($item->tgl),
                'Keterangan' => $item->ket_keaslian,
            ];
        });
    }

    public function headings(): array
    {
        // Tambahkan judul sebagai baris pertama di dalam file Excel
        return [
            [$this->header], // Judul di baris pertama
            [], // Baris kosong untuk spasi
            ['No', 'Kode Klasifikasi', 'Nomor', 'Uraian', 'Retensi', 'Pencipta', 'Unit Pengolah', 'Media', 'Tanggal', 'Keterangan']
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
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Set AutoSize untuk setiap kolom
                foreach (range('A', 'J') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Set border pada tabel
                $sheet->getStyle('A3:J' . (count($this->data) + 3))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Merge cell untuk judul
                $sheet->mergeCells('A1:J1');
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            },
        ];
    }
}
