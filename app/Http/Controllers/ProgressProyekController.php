<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\ReportLists;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProgressProyekController extends Controller
{
    // Display index page for project progress
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

        // Get paginated projects
        $projects = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();

        // Return the view with projects
        return view('pages.progress-proyek.index', compact('projects'));
    }

    // Display the detail page ($id is the project ID)
    public function viewProgress($id) 
    {
        // Find the project by ID
        $project = Project::findOrFail($id);

        // Find the Project Phases based on the project ID
        $phases = ProjectPhase::where('project_id', $id)
            ->orderBy('phase_id', 'asc')
            ->get();
            
        // Return the view with project, phases, and reports
        return view('pages.progress-proyek.view', compact('project', 'phases'));

    }
}
