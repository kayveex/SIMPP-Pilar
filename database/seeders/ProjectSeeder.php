<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'project_name' => 'Pembangunan Jembatan Ciliwung',
                'client_name' => 'PT. Infrastruktur Nusantara',
                'location' => 'Jakarta Timur',
                'budget' => 2500000000,
                'start_date' => Carbon::now()->subMonths(2),
                'estimated_end_date' => Carbon::now()->addMonths(10),
                'project_type' => 'onsite',
                'person_in_charge' => 'Ahmad Sudrajat',
                'status' => 'berlangsung',
                'description' => 'Proyek pembangunan jembatan penghubung daerah Ciliwung dengan kapasitas beban 30 ton',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Renovasi Gedung Perkantoran Wisma Mulia',
                'client_name' => 'PT. Wijaya Karya',
                'location' => 'Jakarta Selatan',
                'budget' => 1750000000,
                'start_date' => Carbon::now()->subMonths(1),
                'estimated_end_date' => Carbon::now()->addMonths(6),
                'project_type' => 'onsite',
                'person_in_charge' => 'Budi Santoso',
                'status' => 'berlangsung',
                'description' => 'Renovasi gedung perkantoran meliputi fasad, interior, dan sistem utilitas',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Pembangunan Perumahan Green Valley',
                'client_name' => 'PT. Ciputra Development',
                'location' => 'Bogor',
                'budget' => 5000000000,
                'start_date' => Carbon::now()->subMonths(5),
                'estimated_end_date' => Carbon::now()->addMonths(12),
                'project_type' => 'onsite',
                'person_in_charge' => 'Citra Dewi',
                'status' => 'berlangsung',
                'description' => 'Pembangunan cluster perumahan dengan 50 unit rumah tipe 45 dan 36',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Konstruksi Jalan Tol Dalam Kota',
                'client_name' => 'Kementerian PUPR',
                'location' => 'Jakarta',
                'budget' => 8500000000,
                'start_date' => Carbon::now()->subDays(15),
                'estimated_end_date' => Carbon::now()->addMonths(24),
                'project_type' => 'onsite',
                'person_in_charge' => 'Dani Hermawan',
                'status' => 'belum_dimulai',
                'description' => 'Pengerjaan jalan tol dalam kota sepanjang 12 km dengan 3 junction utama',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Pembangunan PLTU Muara Karang',
                'client_name' => 'PT. PLN Persero',
                'location' => 'Jakarta Utara',
                'budget' => 12000000000,
                'start_date' => Carbon::now()->subMonths(8),
                'estimated_end_date' => Carbon::now()->addMonths(4),
                'project_type' => 'onsite',
                'person_in_charge' => 'Eka Pratama',
                'status' => 'selesai',
                'description' => 'Pembangunan infrastruktur pendukung PLTU dengan kapasitas 100MW',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}