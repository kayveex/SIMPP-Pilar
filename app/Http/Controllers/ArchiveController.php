<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\FinalProjectReport;
use App\Models\ProjectDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    /**
     * Display the archive main page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $completedProjects = Project::where('status', 'selesai')
            ->with(['finalReport', 'creator', 'documents'])
            ->orderBy('actual_end_date', 'desc')
            ->get();
        
        return view('pages.archive', compact('completedProjects'));
    }
    
    /**
         * Show details of an archived project.
         *
         * @param  int  $id
         * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
         */
        public function show($id)
        {
        $project = Project::with([
                'finalReport', 
                'creator', 
                'documents', 
                'progressReports',
                'expenses',
                'payments'
            ])
            ->findOrFail($id);
            
        // Verify this is a completed project
        if ($project->status !== 'selesai') {
            return redirect()->route('archive.index')
                ->with('error', 'Hanya proyek selesai yang dapat diakses di arsip.');
        }
        
        return view('pages.archive.show', compact('project'));
    }
    
    /**
     * Download a project document.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadDocument($id)
    {
        $document = ProjectDocument::findOrFail($id);
        
        // Check if file exists
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }
        
        return Storage::disk('public')->download(
            $document->file_path, 
            $document->document_name
        );
    }
    
    /**
     * Search the archive.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $completedProjects = Project::where('status', 'selesai')
            ->where(function($q) use ($query) {
                $q->where('project_name', 'like', "%{$query}%")
                  ->orWhere('client_name', 'like', "%{$query}%")
                  ->orWhere('person_in_charge', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->with(['finalReport', 'creator', 'documents'])
            ->orderBy('actual_end_date', 'desc')
            ->get();
            
        return view('pages.archive', compact('completedProjects', 'query'));
    }
    
    /**
     * Export a project report as PDF.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function exportPdf($id)
    {
        $project = Project::with([
                'finalReport', 
                'creator', 
                'progressReports',
                'expenses',
                'payments'
            ])
            ->findOrFail($id);
            
        // Generate PDF report logic would go here
        // This requires a PDF generation library like DomPDF or TCPDF
        
        return redirect()->back()->with('info', 'Fitur export PDF sedang dalam pengembangan.');
    }
}