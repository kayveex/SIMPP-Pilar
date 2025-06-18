<?php

namespace App\Http\Controllers;

use App\Models\AnggaranRealisasi;
use App\Models\AnggaranRencana;
use App\Models\AnggaranRencanaItems;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $anggaranRencana = AnggaranRencana::where('project_id', $project->project_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $anggaranRealisasi = AnggaranRealisasi::where('project_id', $project->project_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.anggaran-proyek.detail', compact('project', 'anggaranRencana', 'anggaranRealisasi'));
    }

    public function addAnggaranRencana($projectId)
    {
        $project = Project::findOrFail($projectId);
        $anggaranRencana = AnggaranRencana::where('project_id', $project->project_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.anggaran-proyek.add-anggara-rencana', compact('project', 'anggaranRencana'));
    }
    
    // Store Anggaran Rencana
    public function storeAnggaranRencana(Request $request, $projectId) 
    {
        $project = Project::findOrFail($projectId);
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $newAnggaranRencana = AnggaranRencana::create([
            'project_id' => $projectId,
            'title' => $request->title,
        ]);

        create_notification(
            'Uraian Anggaran Rencana Baru',
            'Uraian anggaran rencana baru telah ditambahkan pada proyek ' . $project->project_name,
            'success',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $projectId)
            ->with('success', 'Anggaran rencana berhasil ditambahkan.');
    }

    // Store Anggaran Realisasi
    public function storeAnggaranRealisasi(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $newAnggaranRealisasi = AnggaranRealisasi::create([
            'project_id' => $projectId,
            'title' => $request->title,
        ]);

        create_notification(
            'Anggaran Realisasi Baru',
            'Anggaran realisasi baru telah ditambahkan pada proyek ' . $project->project_name,
            'success',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $projectId)
            ->with('success', 'Anggaran realisasi berhasil ditambahkan.');
    }
    
    // Store Anggaran Rencana Items
    public function storeAnggaranRencanaItems(Request $request)
    {
        $request->validate([
            'anggaran_rencana_id' => 'required',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'unit' => 'required|string|max:50',
            'price_per_unit' => 'required|numeric|min:0',
        ]);

        $anggaranRencana = AnggaranRencana::findOrFail($request->anggaran_rencana_id);

        $anggaranRencanaItem = AnggaranRencanaItems::create([
            'anggaran_rencana_id' => $request->anggaran_rencana_id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price_per_unit' => $request->price_per_unit,
            'total_price' => $request->quantity * $request->price_per_unit, // Hitung total harga
        ]);

        create_notification(
            'Item Anggaran Rencana Baru ',
            'Item Anggaran Rencana Baru Telah ditambahkan pada proyek ' . $anggaranRencana->project->project_name,
            'success',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $anggaranRencana->project_id)
            ->with('success', 'Item anggaran rencana berhasil ditambahkan.');
    }

    // Store Anggaran Realisasi Items
    public function storeAnggaranRealisasiItems(Request $request)
    {
        $request->validate([
            'anggaran_realisasi_id' => 'required',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'unit' => 'required|string|max:50',
            'price_per_unit' => 'required|numeric|min:0',
        ]);

        $anggaranRealisasi = AnggaranRealisasi::findOrFail($request->anggaran_realisasi_id);

        $anggaranRealisasiItem = AnggaranRencanaItems::create([
            'anggaran_rencana_id' => $request->anggaran_realisasi_id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price_per_unit' => $request->price_per_unit,
            'total_price' => $request->quantity * $request->price_per_unit, // Hitung total harga
        ]);

        create_notification(
            'Item Anggaran Realisasi Baru ',
            'Item Anggaran Realisasi Baru Telah ditambahkan pada proyek ' . $anggaranRealisasi->project->project_name,
            'success',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $anggaranRealisasi->project_id)
            ->with('success', 'Item anggaran realisasi berhasil ditambahkan.');
    }

    

}
