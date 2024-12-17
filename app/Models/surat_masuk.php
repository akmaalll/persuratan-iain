<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_masuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_surat',
        'nomor',
        'perihal',
        'status',
        'asal',
        'tgl_terima',
        'tgl_input',
        'ttd',
        'tujuan',
        'kepada',
        'jenis',
        'retensi',
        'retensi2',
        'retensi3',
        'riwayat_mutasi',
        'upload_file',

        'nomor_box',
        'nomor_rak',

        'uraian',
        'created_by',
        'updated_by',
    ];

    public function asalSurat()
    {
        return $this->hasOne(kd_unit::class, 'id', 'asal');
    }
    public function tujuanSurat()
    {
        return $this->hasOne(kd_unit::class, 'id', 'tujuan');
    }
}
