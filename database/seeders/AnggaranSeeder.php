<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnggaranSeeder extends Seeder
{
    public function run(): void
    {
        // Get all project IDs
        $projectIds = DB::table('projects')->pluck('project_id')->toArray();
        
        $anggaranRencana = [];
        $anggaranRealisasi = [];
        
        foreach ($projectIds as $projectId) {
            // Create anggaran rencana for each project
            $anggaranRencana[] = [
                'project_id' => $projectId,
                'title' => 'Anggaran Rencana Proyek #' . $projectId,
                'total_budget' => rand(100000000, 1000000000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            
            // Create anggaran realisasi for each project
            $anggaranRealisasi[] = [
                'project_id' => $projectId,
                'title' => 'Anggaran Realisasi Proyek #' . $projectId,
                'total_budget' => rand(50000000, 800000000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        
        DB::table('anggaran_rencana')->insert($anggaranRencana);
        DB::table('anggaran_realisasi')->insert($anggaranRealisasi);
    }
}
