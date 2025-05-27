<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Buat material dasar terlebih dahulu
        $materials = [
            [
                'material_code' => 'MTL001',
                'material_name' => 'Semen',
                'description' => 'Semen Portland tipe I',
                'unit' => 'Sak',
                'unit_price' => 75000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL002',
                'material_name' => 'Pasir',
                'description' => 'Pasir halus untuk konstruksi',
                'unit' => 'Kubik',
                'unit_price' => 250000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL003',
                'material_name' => 'Besi Beton',
                'description' => 'Besi beton 10mm',
                'unit' => 'Batang',
                'unit_price' => 120000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL004',
                'material_name' => 'Kayu',
                'description' => 'Kayu meranti 4x6',
                'unit' => 'Lembar',
                'unit_price' => 180000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL005',
                'material_name' => 'Cat',
                'description' => 'Cat tembok interior',
                'unit' => 'Kaleng',
                'unit_price' => 350000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        
        DB::table('materials')->insert($materials);
        
        // Kemudian buat project materials untuk setiap proyek
        $projectIds = DB::table('projects')->pluck('project_id')->toArray();
        $materialIds = DB::table('materials')->pluck('material_id')->toArray();
        
        foreach ($projectIds as $projectId) {
            // Generate 3-5 material entries per project
            $entries = [];
            
            for ($i = 0; $i < rand(3, 5); $i++) {
                $materialId = $materialIds[array_rand($materialIds)];
                $material = DB::table('materials')->where('material_id', $materialId)->first();
                
                $entries[] = [
                    'project_id' => $projectId,
                    'material_id' => $materialId,
                    'quantity' => rand(10, 100),
                    'unit' => $material->unit,
                    'unit_price' => $material->unit_price,
                    'total_price' => $material->unit_price * rand(10, 100),
                    'status' => ['available', 'pending', 'depleted'][rand(0, 2)],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            
            if (count($entries) > 0) {
                DB::table('project_materials')->insert($entries);
            }
        }
    }
}