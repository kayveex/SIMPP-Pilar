<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Notification;
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

        // Get calendar data for projects (start_date and estimated_end_date)
        $calendarProjects = Project::select('project_id', 'project_name', 'start_date', 'estimated_end_date', 'status')
            ->whereNotNull('start_date')
            ->whereNotNull('estimated_end_date')
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function ($project) {
                return [
                    'id' => $project->project_id,
                    'title' => $project->project_name,
                    'start' => Carbon::parse($project->start_date)->format('Y-m-d'),
                    'end' => Carbon::parse($project->estimated_end_date)->addDay()->format('Y-m-d'),
                    'status' => $project->status,
                    'color' => $this->getProjectColor($project->status)
                ];
            });

        $recentActivities = Notification::orderBy('created_at', 'desc')->limit(5)->get();

        return view('pages.dashboard', compact(
            'activeProjects', 
            'activeProjectsCount', 
            'differenceIn',
            'prevMonthName', 
            'completedProjectsCount', 
            'differenceOut',
            'calendarProjects',
            'recentActivities'
        ));
    }

    /**
     * Get color based on project status
     */
    private function getProjectColor($status)
    {
        switch ($status) {
            case 'berlangsung':
                return '#3B82F6'; // Blue
            case 'belum_dimulai':
                return '#EF4444'; // Red
            case 'tertunda':
                return '#6B7280'; // Gray
            case 'selesai':
                return '#10B981'; // Green
            case 'dibatalkan':
                return '#F59E0B'; // Orange
            default:
                return '#6B7280'; // Gray
        }
    }
}