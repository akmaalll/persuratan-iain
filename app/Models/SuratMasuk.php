<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    // protected $table = 'menu';
    protected $fillable = [
        'parent',
        'name',
        'icon',
        'url',
        'index',
        'sort',
        'active',

        'main_menu',
        'sub_parent'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        // 'deleted_at',
    ];

    public function UserMenu()
    {
        return $this->hasMany('App\Models\UserMenu', 'id_menu', 'id');
    }
}
