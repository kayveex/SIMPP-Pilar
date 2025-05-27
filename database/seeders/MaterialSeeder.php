<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Buat material dasar
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
            ],
            [
                'material_code' => 'MTL006',
                'material_name' => 'Paku',
                'description' => 'Paku ukuran 2 inch',
                'unit' => 'Kg',
                'unit_price' => 25000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL007',
                'material_name' => 'Kawat',
                'description' => 'Kawat bendrat',
                'unit' => 'Roll',
                'unit_price' => 85000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL008',
                'material_name' => 'Bata Merah',
                'description' => 'Bata merah standar',
                'unit' => 'Buah',
                'unit_price' => 1200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL009',
                'material_name' => 'Genteng',
                'description' => 'Genteng keramik',
                'unit' => 'Buah',
                'unit_price' => 8500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_code' => 'MTL010',
                'material_name' => 'Pipa PVC',
                'description' => 'Pipa PVC 4 inch',
                'unit' => 'Batang',
                'unit_price' => 120000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        
        // Insert materials
        DB::table('materials')->insert($materials);
        
        // Get material IDs safely
        $materialIds = DB::table('materials')->pluck('material_id')->toArray();
        
        // Get project IDs safely
        $projectIds = DB::table('projects')->pluck('project_id')->toArray();
        
        if (empty($projectIds)) {
            // Skip the rest if no projects exist
            return;
        }
        
        // For each project, create material requests
        foreach ($projectIds as $projectId) {
            $now = Carbon::now();
            
            $materialRequest = [
                'project_id' => $projectId,
                'requested_by' => 1, // Assuming user ID 1 exists
                'approval_status' => rand(0, 1),
                'approved_by' => rand(0, 1) ? 2 : null,
                'approved_at' => rand(0, 1) ? $now->copy()->subDays(rand(1, 15)) : null,
                'notes' => 'Pengajuan material untuk proyek #' . $projectId,
                'requested_at' => $now->copy()->subDays(rand(15, 30)),
                'updated_at' => $now->copy()->subDays(rand(1, 14))
            ];
            
            // Insert request and get ID properly
            $requestId = DB::table('material_requests')->insertGetId($materialRequest, 'request_id');
            
            // Create 3-5 request items
            $randomCount = rand(3, min(5, count($materialIds)));
            $usedMaterialIds = [];
            
            for ($i = 0; $i < $randomCount; $i++) {
                // Get unused material ID
                do {
                    $materialId = $materialIds[array_rand($materialIds)];
                } while (in_array($materialId, $usedMaterialIds));
                
                $usedMaterialIds[] = $materialId;
                
                // Get material details
                $material = DB::table('materials')->where('material_id', $materialId)->first();
                
                if (!$material) {
                    continue;
                }
                
                // Create request item
                $requestItem = [
                    'request_id' => $requestId,
                    'material_id' => $materialId,
                    'quantity' => rand(5, 50),
                    'unit' => $material->unit,
                    'required_date' => $now->copy()->addDays(rand(7, 30)),
                    'status' => ['pending', 'approved', 'delivered', 'rejected'][rand(0, 3)],
                    'received_quantity' => rand(0, 1) ? rand(1, 50) : null,
                    'received_date' => rand(0, 1) ? $now->copy()->subDays(rand(1, 10)) : null,
                    'notes' => 'Item notes for material #' . $materialId,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
                
                // Insert request item
                DB::table('material_request_items')->insert($requestItem);
            }
            
            // Create project materials (3-6 per project)
            $randomCount = rand(3, min(6, count($materialIds)));
            $usedMaterialIds = [];
            
            for ($i = 0; $i < $randomCount; $i++) {
                // Get unused material ID
                do {
                    $materialId = $materialIds[array_rand($materialIds)];
                } while (in_array($materialId, $usedMaterialIds));
                
                $usedMaterialIds[] = $materialId;
                
                // Get material details
                $material = DB::table('materials')->where('material_id', $materialId)->first();
                
                if (!$material) {
                    continue;
                }
                
                $quantity = rand(10, 100);
                
                // Create project material
                $projectMaterial = [
                    'project_id' => $projectId,
                    'material_id' => $materialId,
                    'quantity' => $quantity,
                    'unit' => $material->unit,
                    'unit_price' => $material->unit_price,
                    'total_price' => $material->unit_price * $quantity,
                    'status' => ['available', 'pending', 'depleted'][rand(0, 2)],
                    'created_at' => $now,
                    'updated_at' => $now
                ];
                
                // Insert project material
                DB::table('project_materials')->insert($projectMaterial);
            }
        }
    }
}