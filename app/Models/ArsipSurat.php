<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_klasifikasi_id',
        'nomor',
        'tgl',
        'perihal',
        'pencipta',
        'unit_pengolah',
        'uraian',
        'lokal',
        'jenis_media',
        'ket_keaslian',
        'jumlah',
        'no_rak',
        'no_box',
        'retensi',
        'file',
        'created_by', 
        'updated_by', 
    ];

    public function klasifikasi() {
        return $this->hasOne(kd_klasifikasi::class, 'id', 'kd_klasifikasi_id');
    }
}
