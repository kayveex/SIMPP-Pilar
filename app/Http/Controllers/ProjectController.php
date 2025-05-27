<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
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
            // 'actual_end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|max:1000',
            'location' => 'nullable|max:255',
        ]);

        // Create project
        $projectData = Project::create([
            'project_name' => $request->project_name,
            'project_type' => $request->project_type,
            'status' => $request->status,
            'person_in_charge' => $request->person_in_charge,
            'client_name' => $request->client_name,
            'start_date' => $request->start_date,
            'estimated_end_date' => $request->estimated_end_date,
            // 'actual_end_date' => $request->actual_end_date,
            'description' => $request->description,
            'location' => $request->location,
            'created_by' => Auth::user()->id,
        ]);

        // Fungsi tambahan untuk unggah file (jika diperlukan)



        // kembali ke halaman daftar proyek dengan pesan sukses
        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil dibuat!');
        
        








        // // Validation logic here
        // $validated = $request->validate([
        //     'project_code' => 'required|unique:projects,project_code',
        //     'project_name' => 'required',
        //     'start_date' => 'required|date',
        //     'estimated_end_date' => 'required|date|after_or_equal:start_date',
        //     'client_name' => 'nullable',
        //     'client_contact' => 'nullable',
        //     'description' => 'nullable',
        //     'budget' => 'nullable|numeric|min:0',
        // ]);
        
        // // Create project
        // $project = Project::create([
        //     'project_code' => $request->project_code,
        //     'project_name' => $request->project_name,
        //     'description' => $request->description,
        //     'client_name' => $request->client_name,
        //     'client_contact' => $request->client_contact,
        //     'start_date' => $request->start_date,
        //     'estimated_end_date' => $request->estimated_end_date,
        //     'status' => 'pending',
        //     'budget' => $request->budget,
        //     'created_by' => Auth::user()->id,
        // ]);
        
        // return redirect()->route('projects.show', $project->project_id)
        //     ->with('success', 'Proyek berhasil dibuat!');
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
