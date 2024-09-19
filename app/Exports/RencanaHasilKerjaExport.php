<?php

namespace App\Exports;

use App\Models\RencanaHasilKerja;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RencanaHasilKerjaExport implements FromView, WithColumnWidths
{
    /**
     * Menyediakan tampilan untuk export.
     *
     * @return View
     */
    public function view(): View
    {
        return view('admin.rencana-hasil-kerja.export', [
            'rhk' => RencanaHasilKerja::all()
        ]);
    }

    /**
     * Mengatur lebar kolom di Excel.
     *
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            // Kolom A sampai P menyesuaikan konten
            'A' => 5,
            'B' => 30,
            'C' => 30,
            'D' => 15,
            'E' => 15,
            'F' => 15, // Ukuran lebar kolom yang sama untuk F sampai AI
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 15,
            'L' => 15,
            'M' => 15,
            'N' => 15,
            'O' => 15,
            'P' => 15,
            'Q' => 15, // Kolom Q dengan lebar yang berbeda (disesuaikan)
            'R' => 15,
            'S' => 15,
            'T' => 15,
            'U' => 15,
            'V' => 15,
            'W' => 15,
            'X' => 15,
            'Y' => 15,
            'Z' => 15,
            'AA' => 15,
            'AB' => 15,
            'AC' => 15,
            'AD' => 15,
            'AE' => 15,
            'AF' => 15,
            'AG' => 15,
            'AH' => 15,
            'AI' => 15,
        ];
    }
}
