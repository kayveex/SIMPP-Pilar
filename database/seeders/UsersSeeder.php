<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin001',
                'email' => 'admin001@gmail.com',
                'password' => bcrypt('admin001'),
                'role' => 'Admin',
            ],
            [
                'name' => 'technical001',
                'email' => 'technical001@gmail.com',
                'password' => bcrypt('technical001'),
                'role' => 'Divisi Teknikal',
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
