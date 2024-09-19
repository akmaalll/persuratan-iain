<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ['role' => 'SU', 'role_name' => 'SuperUser'],
            ['role' => 'A', 'role_name' => 'Admin'],
            ['role' => 'U', 'role_name' => 'Kepala BPFK'],
            ['role' => 'A1', 'role_name' => 'Kasubag'],
            ['role' => 'A2', 'role_name' => 'YANTEK'],
            ['role' => 'A3', 'role_name' => 'ADUM'],
            ['role' => 'A4', 'role_name' => 'TOP'],
        ];

        foreach ($role as $key => $v) {
            Role::create([
                'code' => $v['role'],
                'name' => $v['role_name'],
            ]);
        };
    }
}
