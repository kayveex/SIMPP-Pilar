<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectPhase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ScheduleController extends Controller
{
    /**
     * Display the schedule dashboard (project first).
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Project::query();

        // Filter: Search
        if ($request->filled('search')) {
            $search = strtolower($request->search); // konversi input ke lowercase
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(project_name) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(client_name) LIKE ?', ["%{$search}%"]);
            });
        }

        // Filter: Jenis Proyek
        if ($request->filled('project_type')) {
            $query->where('project_type', $request->project_type);
        }

        // Filter: Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter: Prioritas
        if ($request->filled('priority')) {
            $today = Carbon::today();

            $query->whereNotNull('estimated_end_date')->where(function ($q) use ($request, $today) {
                if ($request->priority === 'high') {
                    $q->whereDate('estimated_end_date', '<=', $today->copy()->addDays(7));
                } elseif ($request->priority === 'medium') {
                    $q->whereDate('estimated_end_date', '<=', $today->copy()->addDays(14))
                    ->whereDate('estimated_end_date', '>', $today->copy()->addDays(7));
                } elseif ($request->priority === 'low') {
                    $q->whereDate('estimated_end_date', '<=', $today->copy()->addDays(30))
                    ->whereDate('estimated_end_date', '>', $today->copy()->addDays(14));
                }
            });
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return view('pages.schedules.index', compact('projects'));

    }

    // Display the schedule dashboard (project phase) from the project.
    public function viewSchedule($id) 
    {
        $project = Project::where('project_id', $id)->firstOrFail();
        $phasesEst = ProjectPhase::where('project_id', $id)
            ->orderBy('estimated_start_date', 'asc')
            ->get();
        $phasesAct = ProjectPhase::where('project_id', $id)
            ->orderBy('actual_start_date', 'asc')
            ->get();

        return view('pages.schedules.view-schedule', compact('project', 'phasesEst', 'phasesAct'));   
    }

    // Store a new project phase
    public function storePhase(Request $request, $id) 
    {
        $request->validate([
            'phase_name' => 'required|string|max:255',
            'estimated_start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:estimated_start_date',
        ]);

        $phase = ProjectPhase::create([
            'phase_name' => $request->phase_name,
            'project_id' => $id,
            'estimated_start_date' => $request->estimated_start_date,
            'estimated_end_date' => $request->estimated_end_date,
            'is_completed' => false,
        ]);

        // After create, count the progress_percentage from Project
        $project = Project::findOrFail($id);
        $isCompletePhase = ProjectPhase::where('project_id', $id)
            ->where('is_completed', true)
            ->count();
        $totalPhases = ProjectPhase::where('project_id', $id)->count();
        $progressPercentage = $totalPhases > 0 ? ($isCompletePhase / $totalPhases) * 100 : 0;
        $project->update(['progress_percentage' => $progressPercentage]);
        // Commit the transaction
        DB::commit();

        // Use helper function to create notification
        create_notification(
            'Fase Proyek Baru Dibuat',
            "Fase proyek baru '{$phase->phase_name}' telah dibuat untuk proyek '{$project->project_name}'.",
            'success',
            Auth::id() // Assuming the creator is the one who should receive the notification
        );

        return redirect()->route('schedules.view', $id)
            ->with('success', 'Project phase created successfully!');
    }

    // PATCH update project phase
    public function updateIsCompleted($id)  
    {
        $phase = ProjectPhase::findOrFail($id);


        DB::beginTransaction();

        try {
            $phase->update([
                'is_completed' => true,
                'actual_end_date' => Carbon::now(),
                'actual_start_date' => $phase->estimated_start_date,
            ]);

            // After update, count the progress_percentage from Project
            $project = Project::findOrFail($phase->project_id);
            $isCompletePhase = ProjectPhase::where('project_id', $phase->project_id)
                ->where('is_completed', true)
                ->count();
            $totalPhases = ProjectPhase::where('project_id', $phase->project_id)->count();
            $progressPercentage = $totalPhases > 0 ? ($isCompletePhase / $totalPhases) * 100 : 0;
            $project->update(['progress_percentage' => $progressPercentage]);

            DB::commit();
            // Use helper function to create notification
            create_notification(
                'Fase Proyek Selesai',
                "Fase proyek '{$phase->phase_name}' telah ditandai selesai pada proyek '{$project->project_name}'.",
                'success',
                Auth::id() // Assuming the creator is the one who should receive the notification
            );
            
            return redirect()->back()
                ->with('success', 'Project phase updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update project phase: ' . $th->getMessage());
        } 
    }

    // PATCH undo update project phase
    public function undoIsCompleted($id)  
    {
        $phase = ProjectPhase::findOrFail($id);

        DB::beginTransaction();

        try {
            $phase->update([
                'is_completed' => false,
                'actual_start_date' => null,
                'actual_end_date' => null,
            ]);

            // After undo, count the progress_percentage from Project
            $project = Project::findOrFail($phase->project_id);
            $isCompletePhase = ProjectPhase::where('project_id', $phase->project_id)
                ->where('is_completed', true)
                ->count();
            $totalPhases = ProjectPhase::where('project_id', $phase->project_id)->count();
            $progressPercentage = $totalPhases > 0 ? ($isCompletePhase / $totalPhases) * 100 : 0;
            $project->update(['progress_percentage' => $progressPercentage]);
            
            DB::commit();

            // Use helper function to create notification
            create_notification(
                'Fase Proyek Tidak Selesai',
                "Fase proyek '{$phase->phase_name}' telah ditandai tidak selesai pada proyek '{$project->project_name}'.",
                'warning',
                Auth::id() // Assuming the creator is the one who should receive the notification
            );

            return redirect()->back()
                ->with('success', 'Project phase update undone successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to undo project phase update: ' . $th->getMessage());
        } 
    }

    // Edit page for project phase
    public function editJadwal($id) 
    {
        $phase = ProjectPhase::findOrFail($id);

        return view('pages.schedules.edit', compact('phase')); 
    }

    // Edit PATCH project phase
    public function updatePhase(Request $request, $id)
    {
        $request->validate([
            'phase_name' => 'required|string|max:255',
            'estimated_start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:estimated_start_date',
            'actual_start_date' => 'nullable|date|after_or_equal:estimated_start_date',
            'actual_end_date' => 'nullable|date|after_or_equal:actual_start_date',
        ]);

        $phase = ProjectPhase::findOrFail($id);
        $phase->update($request->all());

        // Use helper function to create notification
        create_notification(
            'Fase Proyek Diperbarui',
            "Fase proyek '{$phase->phase_name}' telah diperbarui untuk proyek '{$phase->project->project_name}'.",
            'success',
            Auth::id() // Assuming the creator is the one who should receive the notification
        );

        return redirect()->route('schedules.view', $phase->project_id)
            ->with('success', 'Project phase updated successfully!');
    }

    // Delete project phase
    public function destroyPhase($id) 
    {
        $phase = ProjectPhase::findOrFail($id);
        $projectId = $phase->project_id;

        DB::beginTransaction();

        try {
            $phase->delete();

            // After delete, count the progress_percentage from Project
            $project = Project::findOrFail($projectId);
            $isCompletePhase = ProjectPhase::where('project_id', $projectId)
                ->where('is_completed', true)
                ->count();
            $totalPhases = ProjectPhase::where('project_id', $projectId)->count();
            $progressPercentage = $totalPhases > 0 ? ($isCompletePhase / $totalPhases) * 100 : 0;
            $project->update(['progress_percentage' => $progressPercentage]);

            DB::commit();

            // Use helper function to create notification
            create_notification(
                'Fase Proyek Dihapus',  
                "Fase proyek '{$phase->phase_name}' telah dihapus dari proyek '{$project->project_name}'.",
                'warning',
                Auth::id() // Assuming the creator is the one who should receive the notification
            );
            
            return redirect()->route('schedules.view', $projectId)
                ->with('success', 'Project phase deleted successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('schedules.view', $projectId)
                ->with('error', 'Failed to delete project phase: ' . $th->getMessage());
        }
    }
    
}