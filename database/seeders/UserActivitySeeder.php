<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

class UserActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users or create dummy user if none exist
        $users = User::all();
        if ($users->isEmpty()) {
            // Create a dummy user if no users exist
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'Super Admin'
            ]);
            $users = collect([$user]);
        }

        // Dummy activities data
        $activities = [
            [
                'title' => 'membuat proyek baru',
                'message' => 'proyek: Pembangunan Gedung Kantor Baru',
                'type' => 'activity',
                'created_at' => Carbon::now()->subHours(2)
            ],
            [
                'title' => 'menambahkan anggaran rencana baru',
                'message' => 'pada proyek: Renovasi Pabrik A',
                'type' => 'activity',
                'created_at' => Carbon::now()->subHours(4)
            ],
            [
                'title' => 'menyetujui material',
                'message' => 'material: Semen Portland 50kg',
                'type' => 'activity',
                'created_at' => Carbon::now()->subHours(6)
            ],
            [
                'title' => 'mengekspor anggaran realisasi',
                'message' => 'untuk proyek: Pembangunan Jembatan Layang',
                'type' => 'activity',
                'created_at' => Carbon::now()->subHours(8)
            ],            [
                'title' => 'memperbarui detail proyek',
                'message' => 'proyek: Instalasi Sistem Keamanan',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(1)
            ],
            [
                'title' => 'mengajukan material baru',
                'message' => 'material: Besi Beton 12mm',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(1)->subHours(3)
            ],
            [
                'title' => 'menolak material',
                'message' => 'material: Cat Tembok Premium',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(1)->subHours(5)
            ],
            [
                'title' => 'menambahkan anggaran realisasi baru',
                'message' => 'pada proyek: Upgrade Server Infrastruktur',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'title' => 'mengekspor anggaran rencana',
                'message' => 'untuk proyek: Pembangunan Gedung Kantor Baru',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(2)->subHours(4)
            ],
            [
                'title' => 'membuat proyek baru',
                'message' => 'proyek: Maintenance Sistem HVAC',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(3)
            ],
            [
                'title' => 'menyetujui material',
                'message' => 'material: Kabel Listrik 2.5mm',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(3)->subHours(2)
            ],
            [
                'title' => 'memperbarui detail proyek',
                'message' => 'proyek: Renovasi Ruang Meeting',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(4)
            ],
            [
                'title' => 'mengajukan material baru',
                'message' => 'material: Pipa PVC 4 inch',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(4)->subHours(6)
            ],
            [
                'title' => 'menambahkan anggaran rencana baru',
                'message' => 'pada proyek: Instalasi Panel Surya',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(5)
            ],
            [
                'title' => 'mengekspor anggaran realisasi',
                'message' => 'untuk proyek: Pembangunan Parkiran Basement',
                'type' => 'activity',
                'created_at' => Carbon::now()->subDays(5)->subHours(3)
            ]
        ];

        // Insert dummy activities
        foreach ($activities as $activity) {
            $randomUser = $users->random();
            
            Notification::create([
                'user_id' => $randomUser->id,
                'title' => $activity['title'],
                'message' => $activity['message'],
                'type' => $activity['type'],
                'is_read' => false,
                'created_at' => $activity['created_at'],
                'updated_at' => $activity['created_at']
            ]);
        }

        $this->command->info('✅ Dummy user activities created successfully!');
    }
}
