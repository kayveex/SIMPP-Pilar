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
        $projects = [            // Active Projects (Berlangsung)
            [
                'project_name' => 'Honing Line & Hardchrome Piston',
                'client_name' => 'PT. Astra Honda Motor',
                'location' => 'Jakarta',
                'budget' => 450000000,
                'start_date' => Carbon::now()->subMonths(1),
                'estimated_end_date' => Carbon::parse('2025-05-24'),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Ahmad Sudrajat',
                'status' => 'berlangsung',
                'description' => 'Proses honing dan hardchrome untuk komponen piston engine motor',
                'created_by' => 1,
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Fabrikasi Sterntube Stuffing Box',
                'client_name' => 'PT. PAL Indonesia',
                'location' => 'Surabaya',
                'budget' => 750000000,
                'start_date' => Carbon::now()->subDays(45),
                'estimated_end_date' => Carbon::parse('2025-06-01'),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Budi Santoso',
                'status' => 'berlangsung',
                'description' => 'Fabrikasi komponen sterntube stuffing box untuk kapal perang',
                'created_by' => 1,
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Line Boring & Undercoat Polishing',
                'client_name' => 'PT. United Tractors',
                'location' => 'Bekasi',
                'budget' => 320000000,
                'start_date' => Carbon::now()->subDays(20),
                'estimated_end_date' => Carbon::parse('2025-06-12'),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Citra Dewi',
                'status' => 'belum_dimulai',                'description' => 'Line boring dan undercoat polishing untuk engine block alat berat',
                'created_by' => 1,
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Machining Compressor Parts',
                'client_name' => 'PT. Refrigeration Industries',
                'location' => 'Karawang',
                'budget' => 180000000,
                'start_date' => Carbon::now()->subDays(10),
                'estimated_end_date' => Carbon::parse('2025-07-10'),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Dani Hermawan',
                'status' => 'tertunda',
                'description' => 'Machining precision parts untuk kompressor industri',
                'created_by' => 1,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()
            ],
            
            // Completed Projects
            [
                'project_name' => 'Repair Bearing Housing',
                'client_name' => 'PT. Pertamina',
                'location' => 'Cilacap',
                'budget' => 125000000,
                'start_date' => Carbon::now()->subMonths(2),
                'estimated_end_date' => Carbon::parse('2025-05-05'),
                'actual_end_date' => Carbon::parse('2025-05-03'),
                'project_type' => 'onsite',
                'person_in_charge' => 'Eka Pratama',
                'status' => 'selesai',
                'description' => 'Perbaikan bearing housing untuk equipment refinery',
                'created_by' => 1,
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Overhaul Turbine Components',
                'client_name' => 'PT. PLN Persero',
                'location' => 'Muara Karang',
                'budget' => 980000000,
                'start_date' => Carbon::now()->subMonths(4),
                'estimated_end_date' => Carbon::now()->subMonths(1),
                'actual_end_date' => Carbon::now()->subMonths(1)->addDays(3),
                'project_type' => 'onsite',
                'person_in_charge' => 'Ahmad Sudrajat',
                'status' => 'selesai',
                'description' => 'Overhaul komponen turbine PLTU termasuk blade dan rotor',
                'created_by' => 1,
                'created_at' => Carbon::now()->subMonths(5),
                'updated_at' => Carbon::now()
            ],
              // Planning Projects
            [
                'project_name' => 'Cylinder Head Reconditioning',
                'client_name' => 'PT. Toyota Motor Manufacturing',
                'location' => 'Karawang',
                'budget' => 650000000,
                'start_date' => Carbon::now()->addMonths(1),
                'estimated_end_date' => Carbon::now()->addMonths(4),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Budi Santoso',
                'status' => 'belum_dimulai',
                'description' => 'Reconditioning cylinder head untuk engine production line',
                'created_by' => 1,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Crankshaft Grinding & Balancing',
                'client_name' => 'PT. Yamaha Motor Manufacturing',
                'location' => 'Pulogadung',
                'budget' => 420000000,
                'start_date' => Carbon::now()->addWeeks(3),
                'estimated_end_date' => Carbon::now()->addMonths(3),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Citra Dewi',
                'status' => 'belum_dimulai',
                'description' => 'Grinding dan balancing crankshaft untuk motor sport',
                'created_by' => 1,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Valve Seat Machining',
                'client_name' => 'PT. Isuzu Astra Motor Indonesia',
                'location' => 'Bekasi',
                'budget' => 280000000,
                'start_date' => Carbon::now()->addMonths(2),
                'estimated_end_date' => Carbon::now()->addMonths(5),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Dani Hermawan',
                'status' => 'belum_dimulai',
                'description' => 'Machining valve seat untuk diesel engine truck',
                'created_by' => 1,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()
            ],
            
            // Additional Projects
            [
                'project_name' => 'Hydraulic Cylinder Repair',
                'client_name' => 'PT. Komatsu Indonesia',
                'location' => 'Cibitung',
                'budget' => 350000000,
                'start_date' => Carbon::now()->addDays(10),
                'estimated_end_date' => Carbon::now()->addMonths(2),
                'actual_end_date' => null,
                'project_type' => 'onsite',
                'person_in_charge' => 'Eka Pratama',
                'status' => 'belum_dimulai',
                'description' => 'Repair hydraulic cylinder untuk excavator dan bulldozer',
                'created_by' => 1,
                'created_at' => Carbon::now()->subHours(12),
                'updated_at' => Carbon::now()
            ],
            [
                'project_name' => 'Engine Block Reboring',
                'client_name' => 'PT. Mitsubishi Motors',
                'location' => 'Jakarta',
                'budget' => 520000000,
                'start_date' => Carbon::now()->subDays(30),
                'estimated_end_date' => Carbon::now()->addMonths(1),
                'actual_end_date' => null,
                'project_type' => 'workshop',
                'person_in_charge' => 'Ahmad Sudrajat',
                'status' => 'berlangsung',
                'description' => 'Reboring engine block dengan teknisi precision boring',
                'created_by' => 1,
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()
            ],            [
                'project_name' => 'Gear Box Overhaul',
                'client_name' => 'PT. Scania Indonesia',
                'location' => 'Cakung',
                'budget' => 890000000,
                'start_date' => Carbon::now()->subMonths(3),
                'estimated_end_date' => Carbon::now()->subDays(10),
                'actual_end_date' => Carbon::now()->subDays(5),
                'project_type' => 'workshop',
                'person_in_charge' => 'Budi Santoso',
                'status' => 'selesai',
                'description' => 'Complete overhaul gearbox truck dan bus commercial',
                'created_by' => 1,
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()
            ]
        ];

        // Clear existing data first
        DB::table('projects')->truncate();
        
        // Insert new data
        DB::table('projects')->insert($projects);
    }
}