<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ArsipProyekController extends Controller
{
    // Display view for project archives
    public function index(Request $request)
    {
        $query = Project::query();

        // Filter by name/client name
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

        // Tampilkan proyek yang status nya 'selesai'
        $projects = $query->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('pages.arsip-proyek.index', compact('projects'));
    }

    public function showArsip($id)
    {
        $project = Project::findOrFail($id);

        // Pastikan proyek sudah selesai
        if ($project->status !== 'selesai') {
            return redirect()->route('arsip-proyek.index')->with('error', 'Proyek ini belum selesai.');
        }

        return view('pages.arsip-proyek.detail', compact('project'));
    }
}
