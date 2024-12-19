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
        'perihal',
        'status',
        'asal',
        'jenis_nosurat',
        'nomor',
        'tgl_kirim',
        'tgl_input',
        'ttd',
        'tujuan',
        'kepada',
        'jenis',
        'retensi',
        'retensi2',
        'retensi3',
        'file',
        'permintaan',
        'nomor_box',
        'nomor_rak',
        'uraian',
        'created_by',
        'updated_by',
		'status_arsip'
    ];

    public function klasifikasi()
    {
        return $this->hasOne(kd_klasifikasi::class, 'id', 'kd_klasifikasi_id');
    }

    public function noSurat()
    {
        return $this->hasOne(NoSurat::class, 'nomor', 'nomor');
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
