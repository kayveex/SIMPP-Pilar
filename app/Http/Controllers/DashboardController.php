<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get active projects (not completed or rejected)
        $activeProjects = Project::whereNotIn('status', ['selesai', 'ditolak'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($project) {
                $today = Carbon::today();
                $endDate = Carbon::parse($project->estimated_end_date);
                $project->days_remaining = $today->diffInDays($endDate, false);
                return $project;
            });

        return view('pages.dashboard', compact('activeProjects'));
    }
}