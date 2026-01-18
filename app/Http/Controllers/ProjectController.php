<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
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

        // Kecualikan proyek selesai jika status tidak difilter secara eksplisit
        if (!$request->filled('status')) {
            $query->where('status', '!=', 'selesai');
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

        return view('pages.projects.index', compact('projects'));
    }



    /**
     * Show the form for creating a new project.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * Show the alternative form for creating a new project.
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        return view('pages.add');
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|max:255|min:3',
            'project_type' => 'required|in:workshop,onsite',
            'status' => 'required|in:belum_dimulai,berlangsung,tertunda,selesai,dibatalkan',
            'person_in_charge' => 'required|max:255|min:3',
            'client_name' => 'required|max:255|min:3',
            'start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|min:3',
            'location' => 'nullable|max:255|min:3',
        ]);

        DB::beginTransaction();

        try {
            $project = Project::create([
                'project_name' => $request->project_name,
                'project_type' => $request->project_type,
                'status' => $request->status,
                'person_in_charge' => $request->person_in_charge,
                'client_name' => $request->client_name,
                'start_date' => $request->start_date,
                'estimated_end_date' => $request->estimated_end_date,
                'description' => $request->description,
                'location' => $request->location,
                'created_by' => Auth::id(),
            ]);

            // If the request has a file, handle the file upload
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = time() . '_' . Str::random(8) . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('documents', $filename, 'public');

                    ProjectDocument::create([
                        'project_id' => $project->project_id,
                        'document_name' => $filename,
                        'document_type' => $file->getClientMimeType(),
                        'file_path' => $filePath,
                        'uploaded_by' => Auth::id(),
                    ]);
                }
            }

            DB::commit();

            // Create a notification using the helper function
            create_notification(
                'Proyek Baru Telah Dibuat',
                Auth::user()->name . ' telah membuat proyek baru: ' . $project->project_name,
                'success',
                Auth::id()
            );

            return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal membuat proyek: ' . $th->getMessage()]);
        }
    }

    /**
     * Display the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $project = Project::with('documents')->findOrFail($id);
        return view('pages.projects.detail', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $projectDocuments = ProjectDocument::where('project_id', $id)->get();
        return view('pages.projects.edit', compact('project', 'projectDocuments'));
    }

    /**
     * Update the specified project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDetail(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required|max:255',
            'project_type' => 'required|in:workshop,onsite',
            'status' => 'required|in:belum_dimulai,berlangsung,tertunda,selesai,dibatalkan',
            'person_in_charge' => 'required|max:255',
            'client_name' => 'required|max:255',
            'start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:start_date',
            'actual_end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|min:3',
            'location' => 'nullable|max:255',
        ]);

        DB::beginTransaction();

        try {
            $project = Project::findOrFail($id);

            $project->update([
                'project_name' => $request->project_name,
                'project_type' => $request->project_type,
                'status' => $request->status,
                'person_in_charge' => $request->person_in_charge,
                'client_name' => $request->client_name,
                'start_date' => $request->start_date,
                'estimated_end_date' => $request->estimated_end_date,
                'actual_end_date' => $request->actual_end_date,
                'description' => $request->description,
                'location' => $request->location,
            ]);

            // Create notification and log activity
            create_notification(
                'Detail Proyek Diperbarui',
                Auth::user()->name . ' telah memperbarui detail proyek: ' . $project->project_name,
                'success',
                Auth::id()
            );

            DB::commit();
            return redirect()->route('projects.index')->with('success', 'Detail Proyek berhasil diperbarui!');

        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui detail proyek: ' . $th->getMessage()]);
        }
    }


    // Update the permission of the project

    /**
     * Remove the specified project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $project = Project::findOrFail($id);

            // Hapus semua ProjectPhases dan relasi ke ReportLists dan ReportFiles
            foreach ($project->phases as $phase) {
                foreach ($phase->reportLists as $report) {
                    foreach ($report->files as $file) {
                        if (Storage::disk('public')->exists($file->file_path)) {
                            Storage::disk('public')->delete($file->file_path);
                        }
                        $file->delete();
                    }
                    $report->delete();
                }
                $phase->delete();
            }

            // Hapus semua Materials dan relasi ke MaterialRequestItems
            foreach ($project->materials as $material) {
                $material->requestItems()->delete();
                $material->delete();
            }

            // Hapus semua ProjectDocuments dan file fisiknya
            foreach ($project->documents as $document) {
                if (Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
                $document->delete();
            }

            // Hapus semua Anggaran Rencana dan items terkait
            foreach ($project->anggaranRencana as $anggaranRencana) {
                $anggaranRencana->items()->delete();
                $anggaranRencana->delete();
            }

            // Hapus semua Anggaran Realisasi dan items terkait
            foreach ($project->anggaranRealisasi as $anggaranRealisasi) {
                $anggaranRealisasi->items()->delete();
                $anggaranRealisasi->delete();
            }

            // Terakhir, hapus Project itu sendiri
            $project->delete();

            DB::commit();

            // Buat notifikasi menggunakan helper
            create_notification(
                'Proyek Dihapus',
                Auth::user()->name . ' telah menghapus proyek: ' . $project->project_name,
                'warning',
                Auth::id()
            );
            return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus proyek: ' . $th->getMessage()]);
        }
    }

    // Adding new document to project
    public function addDocuments(Request $request, $id)
    {
        $request->validate([
            'attachments.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png',
        ]);

        DB::beginTransaction();

        try {
            $project = Project::findOrFail($id);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = time() . '_' . Str::random(8) . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('documents', $filename, 'public');

                    ProjectDocument::create([
                        'project_id' => $project->project_id,
                        'document_name' => $filename,
                        'document_type' => $file->getClientMimeType(),
                        'file_path' => $filePath,
                        'uploaded_by' => Auth::id(),
                    ]);
                }
            }

            DB::commit();

            // Buat notifikasi menggunakan helper
            create_notification(
                'Dokumen Proyek Ditambahkan',
                Auth::user()->name . ' telah menambahkan dokumen baru ke proyek: ' . $project->project_name,
                'success',
                Auth::id()
            );

            return redirect()->route('projects.show', ['id' => $id])->with('success', 'Dokumen berhasil ditambahkan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan dokumen: ' . $th->getMessage()]);
        }

    }

    // delete document
    public function deleteDocument($id)
    {
        DB::beginTransaction();

        try {
            $document = ProjectDocument::findOrFail($id);

            // Hapus file fisik dari storage
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Hapus data dari database
            $document->delete();

            DB::commit();

            // Buat notifikasi menggunakan helper
            create_notification(
                'Dokumen Proyek Dihapus',
                Auth::user()->name . ' telah menghapus dokumen: ' . $document->document_name,
                'warning',
                Auth::id()
            );

            return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus dokumen: ' . $th->getMessage()]);
        }
    }
}
