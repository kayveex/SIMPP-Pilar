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
        
        $expenses = [];
        $expenseTypes = ['material', 'tenaga_kerja', 'peralatan', 'overhead'];
        
        foreach ($projectIds as $projectId) {
            // Create different expense types for each project
            foreach ($expenseTypes as $type) {
                $amount = rand(5000000, 50000000);
                
                $expenses[] = [
                    'project_id' => $projectId,
                    'expense_type' => $type,
                    'amount' => $amount,
                    'expense_date' => Carbon::now()->subDays(rand(1, 30)),
                    'description' => 'Pengeluaran untuk ' . $type,
                    'created_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            
            // Also create some payments for each project
            $payments[] = [
                'project_id' => $projectId,
                'amount' => rand(10000000, 100000000),
                'payment_date' => Carbon::now()->subDays(rand(1, 45)),
                'payment_method' => ['transfer', 'cash', 'check'][rand(0, 2)],
                'reference_number' => 'REF-' . rand(1000, 9999),
                'status' => ['pending', 'processed', 'completed'][rand(0, 2)],
                'notes' => 'Pembayaran tahap ' . rand(1, 3),
                'recorded_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        
        DB::table('project_expenses')->insert($expenses);
        DB::table('project_payments')->insert($payments);
    }
}