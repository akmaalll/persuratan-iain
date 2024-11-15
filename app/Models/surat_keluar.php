<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surat_keluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_klasifikasi_id',
        'tgl_surat',
        'nomor',
        'perihal',
        'status',
        'asal',
        'tgl_kirim',
        'tgl_input',
        'ttd',
        'tujuan',
        'kepada',
        'jenis',
        'retensi_kategori',
        'retensi',
        'file',
        'created_by',
        'updated_by',
    ];

    public function klasifikasi()
    {
        return $this->hasOne(kd_klasifikasi::class, 'id', 'kd_klasifikasi_id');
    }

    public function asalSurat()
    {
        return $this->hasOne(kd_unit::class, 'id', 'asal');
    }
    public function tujuanSurat()
    {
        return $this->hasOne(kd_unit::class, 'id', 'tujuan');
    }
}
