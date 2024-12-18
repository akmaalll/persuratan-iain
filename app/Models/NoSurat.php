<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoSurat extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_klasifikasi_id',
        'tgl_surat',
        'nomor',
        'jenis',
        'perihal',
        'status',
        'asal',
    ];

    public function klasifikasi()
    {
        return $this->hasOne(kd_klasifikasi::class, 'id', 'kd_klasifikasi_id');
    }
    public function asalSurat()
    {
        return $this->hasOne(kd_unit::class, 'id', 'asal');
    }
}
