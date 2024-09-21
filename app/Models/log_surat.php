<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_surat extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_masuks_id',
        'surat_keluars_id',
        'user_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function surat_masuk() {
        return $this->hasOne(surat_masuk::class);
    }

    public function surat_keluar() {
        return $this->hasOne(surat_keluar::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

}
