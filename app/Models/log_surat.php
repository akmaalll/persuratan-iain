<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_surat extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity',
        'jenis_log',
        'desc',
        'user_id',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
