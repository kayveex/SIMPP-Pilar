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
            $segmentDuration = max(1, $projectDuration / count($activities));
            
            // Create schedule for each activity
            for ($i = 0; $i < count($activities); $i++) {
                $activityStart = $startDate->copy()->addDays($i * $segmentDuration);
                $activityEnd = $activityStart->copy()->addDays($segmentDuration);
                
                // Determine completion status
                $isCompleted = false;
                if ($activityEnd->isPast()) {
                    $isCompleted = true;
                } elseif ($activityStart->isPast() && $activityEnd->isFuture()) {
                    $isCompleted = rand(0, 1); // 50% chance for in-progress phases
                }
                
                $schedules[] = [
                    'project_id' => $projectId,
                    'phase_name' => $activities[$i],
                    'estimated_start_date' => $activityStart,
                    'estimated_end_date' => $activityEnd,
                    'actual_start_date' => $isCompleted ? $activityStart : null,
                    'actual_end_date' => $isCompleted ? $activityEnd : null,
                    'is_completed' => $isCompleted,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        }
        
        DB::table('project_phases')->insert($schedules);
    }
}