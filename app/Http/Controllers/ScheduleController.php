<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display the schedule dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You could load active projects and their schedules here
        $projects = Project::where('status', 'in_progress')->get();
        
        return view('pages.schedule', compact('projects'));
    }
    
    /**
     * Show the schedule management page.
     *
     * @return \Illuminate\View\View
     */
    public function schedule()
    {
        // Get current month and next month for calendar display
        $currentMonth = Carbon::now();
        $nextMonth = Carbon::now()->addMonth();
        
        // You could load scheduled tasks here
        $tasks = Task::whereNotNull('start_date')
                     ->whereNotNull('due_date')
                     ->orderBy('start_date')
                     ->get();
        
        return view('pages.schedule', compact('currentMonth', 'nextMonth', 'tasks'));
    }
    
    /**
     * Update the schedule.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'action' => 'required|string',
            'date' => 'nullable|date',
            // Add other validation rules as needed
        ]);
        
        // Process the schedule update based on the action
        // This is where you would implement the logic shown in your JavaScript functions
        
        // Return a response, possibly with a success message
        return redirect()->route('schedule.edit')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }
}