<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    use HasFactory;
    // protected $table = 'user_menu';
    protected $fillable = [
        'id',
        'id_role',
        'id_menu',
        'read',
        'create',
        'edit',
        'delete',
        'report',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        // 'deleted_at',
    ];

    public function Menu()
    {
        return $this->hasOne('App\Models\Menu', 'id', 'id_menu');
    }

    public function Role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'id_role');
    }
}
