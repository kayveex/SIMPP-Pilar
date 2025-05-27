<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Get all project IDs
        $projectIds = DB::table('projects')->pluck('project_id')->toArray();
        
        $schedules = [];
        $activities = [
            'Persiapan Lahan', 'Pengecoran Pondasi', 'Pemasangan Struktur', 
            'Instalasi Utilitas', 'Finishing Interior', 'Finishing Eksterior',
            'Pemasangan MEP', 'Testing & Commissioning', 'Serah Terima'
        ];
        
        foreach ($projectIds as $projectId) {
            // Get project start and end dates
            $project = DB::table('projects')->where('project_id', $projectId)->first();
            $startDate = Carbon::parse($project->start_date);
            $endDate = Carbon::parse($project->estimated_end_date);
            
            // Calculate duration in days
            $projectDuration = $startDate->diffInDays($endDate);
            $segmentDuration = $projectDuration / count($activities);
            
            // Create schedule for each activity
            for ($i = 0; $i < count($activities); $i++) {
                $activityStart = $startDate->copy()->addDays($i * $segmentDuration);
                $activityEnd = $activityStart->copy()->addDays($segmentDuration);
                
                // Progress status
                $progress = 0;
                if ($activityEnd->isPast()) {
                    $progress = 100; // Completed
                } elseif ($activityStart->isPast() && $activityEnd->isFuture()) {
                    $progress = rand(10, 90); // In progress
                }
                
                $schedules[] = [
                    'project_id' => $projectId,
                    'task_name' => $activities[$i],
                    'description' => 'Pengerjaan ' . $activities[$i],
                    'start_date' => $activityStart,
                    'due_date' => $activityEnd,
                    'status' => $progress == 100 ? 'completed' : ($progress > 0 ? 'in_progress' : 'pending'),
                    'priority' => rand(1, 3),
                    'created_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        }
        
        DB::table('tasks')->insert($schedules);
    }
}