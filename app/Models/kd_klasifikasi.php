<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kd_klasifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_klasifikasi_id',
        'nomor',
        'nama',
    ];

    public function jenis_klasifikasi() {
        return $this->hasOne(JenisKlasifikasi::class);
    }
}
