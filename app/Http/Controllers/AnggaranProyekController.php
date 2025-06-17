<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnggaranProyekController extends Controller
{
    
    // Display index page for Anggaran Proyek
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

        $projects = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return view('pages.anggaran-proyek.index', compact('projects'));
    }

    public function detailAnggaran($projectId)
    {
        $project = Project::findOrFail($projectId);

        // // Ambil semua anggaran dan relasi anggaranItems sekaligus
        // $anggaran = Anggaran::with('anggaranItems')
        //     ->where('project_id', $projectId)
        //     ->get();

        // // Flatten semua anggaranItems jadi satu collection
        // $anggaranItems = $anggaran->pluck('anggaranItems')->flatten();

        return view('pages.anggaran-proyek.detail', compact('project'));
    }

    

}
