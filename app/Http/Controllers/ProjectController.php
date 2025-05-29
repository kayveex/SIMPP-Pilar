<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDocument;
use Illuminate\Http\Request;
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
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('project_name', 'like', "%$search%")
                ->orWhere('client_name', 'like', "%$search%");
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
            'project_name' => 'required|max:255',
            'project_type' => 'required|in:bengkel,onsite',
            'status' => 'required|in:belum_dimulai,berlangsung,tertunda,selesai,dibatalkan',
            'person_in_charge' => 'required|max:255',
            'client_name' => 'required|max:255',
            'start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|max:1000',
            'location' => 'nullable|max:255',
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

            return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat!');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
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
        $project = Project::findOrFail($id);
        return view('pages.projects.show', compact('project'));
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
        return view('pages.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation logic here
        $validated = $request->validate([
            'project_code' => 'required|unique:projects,project_code,'.$id.',project_id',
            'project_name' => 'required',
            'start_date' => 'required|date',
            'estimated_end_date' => 'required|date|after_or_equal:start_date',
            'client_name' => 'nullable',
            'client_contact' => 'nullable',
            'description' => 'nullable',
            'budget' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,in_progress,completed,canceled',
        ]);
        
        $project = Project::findOrFail($id);
        $project->update($request->all());
        
        return redirect()->route('projects.show', $project->project_id)
            ->with('success', 'Proyek berhasil diperbarui!');
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        
        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil dihapus!');
    }
}
