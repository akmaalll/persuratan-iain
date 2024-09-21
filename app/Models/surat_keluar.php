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
        'retensi', 
    ];

    public function klasifikasi() {
        return $this->hasOne(kd_klasifikasi::class);
    }

    
}


