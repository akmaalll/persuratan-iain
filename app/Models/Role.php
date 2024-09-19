<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // protected $table = 'roles';
    protected $fillable = [
        'id',
        'code',
        'name',
        // 'active',
        // 'created_by',
        // 'updated_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        // 'deleted_at',
    ];
}
