<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectPhase;
use Carbon\Carbon;

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
    
}