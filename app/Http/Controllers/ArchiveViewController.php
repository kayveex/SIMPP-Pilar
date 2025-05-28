<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\ProgressReport;
use App\Models\FinalProjectReport;
use Illuminate\Http\Request;

class ArchiveViewController extends Controller
{
    /**
     * Display the archive view details for a specific project.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index($id)
    {
        $project = Project::with([
            'finalReport',
            'creator',
            'documents',
            'progressReports',
            'expenses',
            'payments',
            'team.user'
        ])->findOrFail($id);
        
        // Ensure the project is in the archive (completed)
        if ($project->status !== 'selesai') {
            return redirect()->route('archive')
                ->with('error', 'Hanya proyek selesai yang dapat dilihat di arsip.');
        }
        
        // Calculate project financials
        $totalExpenses = $project->expenses->sum('amount');
        $totalPayments = $project->payments->sum('amount');
        $balance = $totalPayments - $totalExpenses;
        
        return view('pages.archive_view', compact(
            'project',
            'totalExpenses',
            'totalPayments',
            'balance'
        ));
    }
    
    /**
     * Show project details section of archive view.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function details($id)
    {
        $project = Project::with(['finalReport', 'creator', 'team.user'])
            ->findOrFail($id);
            
        return view('pages.archive_details', compact('project'));
    }
    
    /**
     * Show project schedule section of archive view.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function schedule($id)
    {
        $project = Project::with(['progressReports'])
            ->findOrFail($id);
            
        return view('pages.archive_schedule', compact('project'));
    }
    
    /**
     * Show project notes section of archive view.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function notes($id)
    {
        $project = Project::with(['documents'])
            ->findOrFail($id);
            
        return view('pages.archive_notes', compact('project'));
    }
    
    /**
     * Show project budget section of archive view.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function budget($id)
    {
        $project = Project::with(['expenses', 'payments'])
            ->findOrFail($id);
            
        return view('pages.archive_budget', compact('project'));
    }
}