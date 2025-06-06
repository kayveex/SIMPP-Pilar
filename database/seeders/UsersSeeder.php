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
                'role' => 'Divisi Admin',
            ],
            [
                'name' => 'technical001',
                'email' => 'technical001@gmail.com',
                'password' => bcrypt('technical001'),
                'role' => 'Divisi Teknikal',
            ],
            [
                'name' => 'purchasing001',
                'email' => 'purchasing001@gmail.com',
                'password' => bcrypt('purchasing001'),
                'role' => 'Divisi Purchasing',
            ],
            [
                'name' => 'finance001',
                'email' => 'finance001@gmail.com',
                'password' => bcrypt('finance001'),
                'role' => 'Divisi Finance',
            ],
            [
                'name' => 'director001',
                'email' => 'director001@gmail.com',
                'password' => bcrypt('director001'),
                'role' => 'Direktur',
            ],
            [
                'name' => 'superadmin01',
                'email' => 'superadmin01',
                'password' => bcrypt('superadmin01'),
                'role' => 'Super Admin',
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
