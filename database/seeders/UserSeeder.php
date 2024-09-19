<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usr = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123'),
                'role' => 1,
            ],
        ];

        foreach ($usr as $v) {
            User::create([
                'name' => $v['name'],
                'username' => $v['username'],
                'email' => $v['email'],
                'password' => $v['password'],
                'id_role' => $v['role'],
            ]);
        };
    }
}
