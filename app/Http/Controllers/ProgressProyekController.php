<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\ReportFiles;
use App\Models\ReportLists;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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

    // Display the report list for a specific project_phases

    public function viewReport($id)  
    {
        // Find the project phase by ID
        $phase = ProjectPhase::findOrFail($id);

        // Get the reports for this phase
        $reports = ReportLists::where('phase_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the view with phase and reports
        return view('pages.progress-proyek.detail-progress', compact('phase', 'reports'));

    }

    // View Detail Report
    public function viewDetailReport($reportId)
    {
        //Find the report by ID
        $report = ReportLists::findOrFail($reportId);

        // Get the files associated with this report
        $files = ReportFiles::where('report_id', $reportId)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Return the view with report and files
        return view('pages.progress-proyek.detail-catatan', compact('report', 'files'));

    }

    // POST store a new report from the project phase
    public function storeReport(Request $request, $id) 
    {
        // Validate the request
        $request->validate([
            'report_title' => 'required|string|max:255',
            'report_type' => 'required|in:harian,mingguan,bulanan,kendala,penyelesaian',
            'activity' => 'nullable|string|min:3',
            'trouble' => 'nullable|string|min:3',
            'solution' => 'nullable|string|min:3',
        ]);

        DB::beginTransaction();

        // Create a new report
        try {
            $report = ReportLists::create([
                'phase_id' => $id,
                'report_title' => $request->report_title,
                'report_type' => $request->report_type,
                'activity' => $request->activity,
                'trouble' => $request->trouble,
                'solution' => $request->solution,
                'report_date' => Carbon::now(), 
            ]);

            if ($request->hasFile('report_files')) {
                foreach ($request->file('report_files') as $file) {
                    $filename = time() . '_' . Str::random(8) . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('reports', $filename, 'public');

                    ReportFiles::create([
                        'report_id' => $report->report_id,
                        'file_name' => $filename,
                        'file_path' => $filePath,
                        'file_type' => $file->getClientMimeType(),
                        'description' => 'Lampiran untuk laporan ' . $report->report_title,
                    ]);
                }
            }
    
            DB::commit();

            // Back to the report view with success message
            return redirect()->route('progress-proyek.report', $id)
                ->with('success', 'Laporan berhasil dibuat dan file berhasil diunggah.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            // Back to the report view with error message
            return redirect()->route('progress-proyek.report', $id)
                ->withErrors(['error' => 'Gagal membuat laporan: ' . $th->getMessage()]);
        }




        // Check if there are any files to upload 
    }

    // PATCH edit a Report List
    public function editReport(Request $request, $reportId) 
    {
        // Validate the request
        $request->validate([
            'report_title' => 'required|string|max:255',
            'activity' => 'nullable|string|min:3',
            'trouble' => 'nullable|string|min:3',
            'solution' => 'nullable|string|min:3',
        ]);

        DB::beginTransaction();

        try {
            // Find the report by ID
            $report = ReportLists::findOrFail($reportId);

            // Update the report details
            $report->update([
                'report_title' => $request->report_title,
                'activity' => $request->activity,
                'trouble' => $request->trouble,
                'solution' => $request->solution,
                'report_date' => Carbon::now(), 
            ]);

            DB::commit();

            // Redirect back with success message
            return redirect()->back()
                ->with('success', 'Laporan berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Gagal memperbarui laporan: ' . $th->getMessage()]);
        }
    }

    // add report files
    public function addReportFiles(Request $request, $reportId) 
    {
        // Validate the request
        $request->validate([
            'report_files.*' => 'required|file|mimes:pdf,jpg,jpeg,png', // max 2MB
        ]);

        DB::beginTransaction();

        try {
            // Find the report by ID
            $report = ReportLists::findOrFail($reportId);

            // Process each file
            foreach ($request->file('report_files') as $file) {
                $filename = time() . '_' . Str::random(8) . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('reports', $filename, 'public');

                ReportFiles::create([
                    'report_id' => $report->report_id,
                    'file_name' => $filename,
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                    'description' => 'Lampiran untuk laporan ' . $report->report_title,
                ]);
            }

            DB::commit();

            // Redirect back with success message
            return redirect()->back()
                ->with('success', 'File berhasil diunggah.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Gagal mengunggah file: ' . $th->getMessage()]);
        }
    }

    // Delete report files
    public function deleteReportFile($fileId) 
    {
        // Find the file by ID
        $file = ReportFiles::findOrFail($fileId);

        DB::beginTransaction();

        try {
            // Delete the file from storage
            Storage::disk('public')->delete($file->file_path);

            // Delete the file record from the database
            $file->delete();

            DB::commit();

            // Redirect back with success message
            return redirect()->back()
                ->with('success', 'File berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menghapus file: ' . $th->getMessage()]);
        }
    }

    // Delete a Report List and its associated files
    public function deleteReport($reportId) 
    {
        // Find the report by ID
        $report = ReportLists::findOrFail($reportId);

        DB::beginTransaction();

        try {
            // Delete associated files
            $files = ReportFiles::where('report_id', $reportId)->get();
            foreach ($files as $file) {
                Storage::disk('public')->delete($file->file_path);
                $file->delete();
            }

            // Delete the report
            $report->delete();

            DB::commit();

            // Redirect back with success message
            return redirect()->back()
                ->with('success', 'Laporan berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menghapus laporan: ' . $th->getMessage()]);
        }
    }
}
