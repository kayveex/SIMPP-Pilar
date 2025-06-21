<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;

class ProjectCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user or create dummy user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Project Manager',
                'email' => 'pm@example.com',
                'password' => bcrypt('password'),
                'role' => 'Project Manager'
            ]);
        }

        // Dummy projects with dates for calendar
        $projects = [
            [
                'project_name' => 'Pembangunan Gedung Kantor Baru',
                'project_type' => 'onsite',
                'status' => 'berlangsung',
                'person_in_charge' => 'Budi Santoso',
                'client_name' => 'PT. Maju Jaya',
                'start_date' => Carbon::now()->subDays(10),
                'estimated_end_date' => Carbon::now()->addDays(30),
                'description' => 'Pembangunan gedung kantor 5 lantai',
                'location' => 'Jakarta Selatan',
                'created_by' => $user->id
            ],
            [
                'project_name' => 'Renovasi Pabrik A',
                'project_type' => 'onsite',
                'status' => 'belum_dimulai',
                'person_in_charge' => 'Siti Nurhaliza',
                'client_name' => 'PT. Industri Makmur',
                'start_date' => Carbon::now()->addDays(5),
                'estimated_end_date' => Carbon::now()->addDays(45),
                'description' => 'Renovasi dan upgrade fasilitas pabrik',
                'location' => 'Bekasi',
                'created_by' => $user->id
            ],
            [
                'project_name' => 'Instalasi Sistem Keamanan',
                'project_type' => 'workshop',
                'status' => 'berlangsung',
                'person_in_charge' => 'Ahmad Fauzi',
                'client_name' => 'PT. Teknologi Canggih',
                'start_date' => Carbon::now()->subDays(5),
                'estimated_end_date' => Carbon::now()->addDays(15),
                'description' => 'Instalasi CCTV dan sistem akses kontrol',
                'location' => 'Tangerang',
                'created_by' => $user->id
            ],
            [
                'project_name' => 'Pembangunan Jembatan Layang',
                'project_type' => 'onsite',
                'status' => 'tertunda',
                'person_in_charge' => 'Rina Maharani',
                'client_name' => 'Dinas Pekerjaan Umum',
                'start_date' => Carbon::now()->addDays(20),
                'estimated_end_date' => Carbon::now()->addDays(120),
                'description' => 'Pembangunan jembatan layang untuk mengurangi kemacetan',
                'location' => 'Jakarta Timur',
                'created_by' => $user->id
            ],
            [
                'project_name' => 'Upgrade Server Infrastruktur',
                'project_type' => 'workshop',
                'status' => 'selesai',
                'person_in_charge' => 'Dedi Kurniawan',
                'client_name' => 'PT. Digital Solutions',
                'start_date' => Carbon::now()->subDays(30),
                'estimated_end_date' => Carbon::now()->subDays(5),
                'description' => 'Upgrade server dan infrastruktur jaringan',
                'location' => 'Jakarta Pusat',
                'created_by' => $user->id
            ],
            [
                'project_name' => 'Maintenance Sistem HVAC',
                'project_type' => 'onsite',
                'status' => 'berlangsung',
                'person_in_charge' => 'Lisa Permata',
                'client_name' => 'PT. Mall Megah',
                'start_date' => Carbon::now()->subDays(3),
                'estimated_end_date' => Carbon::now()->addDays(12),
                'description' => 'Perawatan dan perbaikan sistem HVAC mall',
                'location' => 'Jakarta Barat',
                'created_by' => $user->id
            ],
            [
                'project_name' => 'Instalasi Panel Surya',
                'project_type' => 'onsite',
                'status' => 'belum_dimulai',
                'person_in_charge' => 'Eko Prasetyo',
                'client_name' => 'PT. Green Energy',
                'start_date' => Carbon::now()->addDays(15),
                'estimated_end_date' => Carbon::now()->addDays(60),
                'description' => 'Instalasi panel surya untuk energi terbarukan',
                'location' => 'Depok',
                'created_by' => $user->id
            ],
            [
                'project_name' => 'Pembangunan Parkiran Basement',
                'project_type' => 'onsite',
                'status' => 'dibatalkan',
                'person_in_charge' => 'Tono Sugiarto',
                'client_name' => 'PT. Property Prima',
                'start_date' => Carbon::now()->addDays(25),
                'estimated_end_date' => Carbon::now()->addDays(90),
                'description' => 'Pembangunan parkiran basement 2 lantai',
                'location' => 'Bogor',
                'created_by' => $user->id
            ]
        ];

        // Insert dummy projects
        foreach ($projects as $projectData) {
            Project::create($projectData);
        }

        $this->command->info('✅ Dummy projects for calendar created successfully!');
    }
}
