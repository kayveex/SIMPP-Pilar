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
                'material_title' => 'Pengajuan Semen Proyek A',
                'material_notes' => 'Semen Portland tipe I untuk pondasi',
                'vendor' => 'PT. Semen Indonesia',
                'client_name' => 'PT. Infrastruktur Nusantara',
                'purchasing_approval' => true,
                'purchasing_approval_date' => Carbon::now()->subDays(rand(1, 30)),
                'estimated_arrival_date' => Carbon::now()->addDays(rand(7, 30)),
                'actual_arrival_date' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 10)) : null,
                'approval_status' => ['diproses', 'dipesan', 'diterima', 'disetujui'][rand(0, 3)],
                'invoice' => rand(0, 1) ? 'INV-' . rand(1000, 9999) : null,
                'created_by' => 1,
                'project_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_title' => 'Pengajuan Pasir Proyek B',
                'material_notes' => 'Pasir halus untuk konstruksi',
                'vendor' => 'CV. Pasir Jaya',
                'client_name' => 'PT. Wijaya Karya',
                'purchasing_approval' => true,
                'purchasing_approval_date' => Carbon::now()->subDays(rand(1, 30)),
                'estimated_arrival_date' => Carbon::now()->addDays(rand(7, 30)),
                'actual_arrival_date' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 10)) : null,
                'approval_status' => ['diproses', 'dipesan', 'diterima', 'disetujui'][rand(0, 3)],
                'invoice' => rand(0, 1) ? 'INV-' . rand(1000, 9999) : null,
                'created_by' => 1,
                'project_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_title' => 'Pengajuan Besi Beton',
                'material_notes' => 'Besi beton 10mm untuk struktur',
                'vendor' => 'PT. Krakatau Steel',
                'client_name' => 'PT. Ciputra Development',
                'purchasing_approval' => false,
                'purchasing_approval_date' => null,
                'estimated_arrival_date' => Carbon::now()->addDays(rand(7, 30)),
                'actual_arrival_date' => null,
                'approval_status' => 'diproses',
                'invoice' => null,
                'created_by' => 1,
                'project_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_title' => 'Pengajuan Kayu Meranti',
                'material_notes' => 'Kayu meranti 4x6 untuk bekisting',
                'vendor' => 'PT. Kayu Nusantara',
                'client_name' => 'Kementerian PUPR',
                'purchasing_approval' => true,
                'purchasing_approval_date' => Carbon::now()->subDays(rand(1, 30)),
                'estimated_arrival_date' => Carbon::now()->addDays(rand(7, 30)),
                'actual_arrival_date' => Carbon::now()->subDays(rand(1, 5)),
                'approval_status' => 'diterima',
                'invoice' => 'INV-' . rand(1000, 9999),
                'created_by' => 1,
                'project_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'material_title' => 'Pengajuan Cat Tembok',
                'material_notes' => 'Cat tembok interior untuk finishing',
                'vendor' => 'PT. Dulux Indonesia',
                'client_name' => 'PT. PLN Persero',
                'purchasing_approval' => true,
                'purchasing_approval_date' => Carbon::now()->subDays(rand(1, 30)),
                'estimated_arrival_date' => Carbon::now()->addDays(rand(7, 30)),
                'actual_arrival_date' => Carbon::now()->subDays(rand(1, 5)),
                'approval_status' => 'disetujui',
                'invoice' => 'INV-' . rand(1000, 9999),
                'created_by' => 1,
                'project_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        
        // Insert materials
        DB::table('materials')->insert($materials);
        
        // Get material IDs
        $materialIds = DB::table('materials')->pluck('material_id')->toArray();
        
        if (empty($materialIds)) {
            return;
        }
        
        // Create material request items for existing materials
        $materialRequestItems = [];
        
        foreach ($materialIds as $materialId) {
            $material = DB::table('materials')->where('material_id', $materialId)->first();
            
            if (!$material) {
                continue;
            }
            
            // Create material request item
            $materialRequestItems[] = [
                'material_id' => $materialId,
                'item_name' => $material->material_title,
                'quantity' => rand(5, 50),
                'unit' => 'pcs',
                'price_per_unit' => rand(10000, 500000),
                'total_price' => rand(500000, 25000000),
                'required_date' => Carbon::now()->addDays(rand(7, 30)),
                'received_quantity' => rand(0, 1) ? rand(1, 50) : null,
                'received_date' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 10)) : null,
                'notes' => 'Material request for ' . $material->material_title,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        
        DB::table('material_request_items')->insert($materialRequestItems);
    }
}
