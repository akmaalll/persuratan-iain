<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\UserMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = Menu::all();
        foreach ($data as $v) {
            UserMenu::create([
                'id' => Str::uuid(),
                'id_role' => 1,
                'id_menu' => $v->id,
                'read' => 1,
                'create' => 1,
                'edit' => 1,
                'delete' => 1,
                'report' => 1,
            ]);
        };
    }
}
