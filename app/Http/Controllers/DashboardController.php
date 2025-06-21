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

        // Count the number of active projects, without limiting the query
        $activeProjectsCount = Project::whereNotIn('status', ['selesai', 'ditolak'])->count();
        // count the number of project 'selesai' only
        $completedProjectsCount = Project::where('status', 'selesai')->count();
        // Hitung komparasi project bulan ini dengan bulan lalu berdasarkan start_date
        $currentMonth = Carbon::now()->month;
        $previousMonth = Carbon::now()->subMonth()->month;
        $currentMonthCount = Project::whereMonth('start_date', $currentMonth)->count();
        $previousMonthCount = Project::whereMonth('start_date', $previousMonth)->count();

        $currentMonthCountCompleted  = Project::whereMonth('start_date', $currentMonth)
            ->where('status', 'selesai')
            ->count();
        $previousMonthCountCompleted = Project::whereMonth('start_date', $previousMonth)
            ->where('status', 'selesai')
            ->count();
        // Hitung selisih antara bulan ini dan bulan lalu
        $differenceOut = $currentMonthCountCompleted - $previousMonthCountCompleted;

        $differenceIn = $currentMonthCount - $previousMonthCount;
        $prevMonthName = Carbon::now()->subMonth()->format('F');




        return view('pages.dashboard', compact('activeProjects', 'activeProjectsCount', 'differenceIn','prevMonthName', 'completedProjectsCount', 'differenceOut'));
    }
}