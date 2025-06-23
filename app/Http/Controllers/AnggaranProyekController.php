<?php

namespace App\Http\Controllers;

use App\Models\AnggaranRealisasi;
use App\Models\AnggaranRealisasiItems;
use App\Models\AnggaranRencana;
use App\Models\AnggaranRencanaItems;
use App\Models\Project;
use App\Exports\BudgetExport;
use App\Exports\AnggaranRencanaExport;
use App\Exports\AnggaranRealisasiExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            ->orderBy('created_at', 'asc')
            ->get();
        $anggaranRealisasi = AnggaranRealisasi::where('project_id', $project->project_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.anggaran-proyek.detail', compact('project', 'anggaranRencana', 'anggaranRealisasi'));
    }

    public function addAnggaranRencana($projectId)
    {
        $project = Project::findOrFail($projectId);
        $anggaranRencana = AnggaranRencana::where('project_id', $project->project_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.anggaran-proyek.add-anggaran-rencana', compact('project', 'anggaranRencana'));
    }

    public function addAnggaranRealisasi($projectId)
    {
        $project = Project::findOrFail($projectId);
        $anggaranRealisasi = AnggaranRealisasi::where('project_id', $project->project_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.anggaran-proyek.add-anggaran-realisasi', compact('project', 'anggaranRealisasi'));
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
            Auth::user()->name . ' telah menambahkan uraian anggaran rencana baru pada proyek ' . $project->project_name,
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
            Auth::user()->name . ' telah menambahkan anggaran realisasi baru pada proyek ' . $project->project_name,
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

        // Ambil unit final (jika 'lainnya', pakai input custom)
        $finalUnit = $request->unit === 'lainnya' ? $request->custom_unit : $request->unit;

        $anggaranRencanaItem = AnggaranRencanaItems::create([
            'anggaran_rencana_id' => $request->anggaran_rencana_id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'unit' => $finalUnit,
            'price_per_unit' => $request->price_per_unit,
            'total_price' => $request->quantity * $request->price_per_unit, // Hitung total harga
        ]);

        create_notification(
            'Item Anggaran Rencana Baru ',
            Auth::user()->name . ' telah menambahkan item anggaran rencana baru pada proyek ' . $anggaranRencana->project->project_name,
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

        // Ambil unit final (jika 'lainnya', pakai input custom)
        $finalUnit = $request->unit === 'lainnya' ? $request->custom_unit : $request->unit;

        $anggaranRealisasiItem = AnggaranRealisasiItems::create([
            'anggaran_realisasi_id' => $request->anggaran_realisasi_id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'unit' => $finalUnit,
            'price_per_unit' => $request->price_per_unit,
            'total_price' => $request->quantity * $request->price_per_unit, // Hitung total harga
        ]);

        create_notification(
            'Item Anggaran Realisasi Baru ',
            Auth::user()->name . ' telah menambahkan item anggaran realisasi baru pada proyek ' . $anggaranRealisasi->project->project_name,
            'success',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $anggaranRealisasi->project_id)
            ->with('success', 'Item anggaran realisasi berhasil ditambahkan.');
    }

    // Delete Anggaran Rencana
    public function deleteAnggaranRencana($id)
    {
        // Hapus Anggaran Rencana dan semua item terkait
        $anggaranRencana = AnggaranRencana::findOrFail($id);
        $projectId = $anggaranRencana->project_id;
        $anggaranRencana->items()->delete(); // Hapus semua item terkait
        $anggaranRencana->delete(); // Hapus Anggaran Rencana

        create_notification(
            'Anggaran Rencana Dihapus',
            Auth::user()->name . ' telah menghapus anggaran rencana dari proyek ' . $anggaranRencana->project->project_name,
            'warning',
            Auth::id()
        );
        return redirect()->route('anggaran-proyek.detail', $projectId)
            ->with('success', 'Anggaran rencana berhasil dihapus.');
  
    }

    // Hapus Anggaran Realisasi dan semua item terkait
    public function deleteAnggaranRealisasi($id)
    {
        $anggaranRealisasi = AnggaranRealisasi::findOrFail($id);
        $projectId = $anggaranRealisasi->project_id;
        $anggaranRealisasi->items()->delete(); // Hapus semua item terkait
        $anggaranRealisasi->delete(); // Hapus Anggaran Realisasi

        create_notification(
            'Anggaran Realisasi Dihapus',
            Auth::user()->name . ' telah menghapus anggaran realisasi dari proyek ' . $anggaranRealisasi->project->project_name,
            'warning',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $projectId)
            ->with('success', 'Anggaran realisasi berhasil dihapus.');
        
    }
    
    // Delete Anggaran Rencana Item
    public function deleteAnggaranRencanaItem($id)
    {
        // Hapus Anggaran Rencana Item
        $anggaranRencanaItem = AnggaranRencanaItems::findOrFail($id);
        $anggaranRencanaId = $anggaranRencanaItem->anggaran_rencana_id;
        $anggaranRencanaItem->delete();

        create_notification(
            'Item Anggaran Rencana Dihapus',
            Auth::user()->name . ' telah menghapus item anggaran rencana: ' . $anggaranRencanaItem->item_name,
            'warning',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $anggaranRencanaId)
            ->with('success', 'Item anggaran rencana berhasil dihapus.');
    }
    
    // Delete Anggaran Realisasi Item
    public function deleteAnggaranRealisasiItem($id)
    {
        // Hapus Anggaran Realisasi Item
        $anggaranRealisasiItem = AnggaranRencanaItems::findOrFail($id);
        $anggaranRealisasiId = $anggaranRealisasiItem->anggaran_rencana_id;
        $anggaranRealisasiItem->delete();

        create_notification(
            'Item Anggaran Realisasi Dihapus',
            Auth::user()->name . ' telah menghapus item anggaran realisasi: ' . $anggaranRealisasiItem->item_name,
            'warning',
            Auth::id()
        );

        return redirect()->route('anggaran-proyek.detail', $anggaranRealisasiId)
            ->with('success', 'Item anggaran realisasi berhasil dihapus.');
    }

    /**
     * Export budget data to Excel
     */
    public function exportBudget($projectId)
    {
        $project = Project::findOrFail($projectId);
        $fileName = 'Anggaran_' . str_replace(' ', '_', $project->project_name) . '_' . date('Y-m-d') . '.xlsx';
        
        return Excel::download(new BudgetExport($projectId), $fileName);
    }

    /**
     * Export Anggaran Rencana to Excel
     */
    public function exportAnggaranRencana($projectId)
    {
        $project = Project::findOrFail($projectId);
        $fileName = 'Anggaran_Rencana_' . str_replace(' ', '_', $project->project_name) . '_' . date('Y-m-d') . '.xlsx';
        
        
        return Excel::download(new AnggaranRencanaExport($projectId), $fileName);
    }

    /**
     * Export Anggaran Realisasi to Excel
     */
    public function exportAnggaranRealisasi($projectId)
    {
        $project = Project::findOrFail($projectId);
        $fileName = 'Anggaran_Realisasi_' . str_replace(' ', '_', $project->project_name) . '_' . date('Y-m-d') . '.xlsx';
             
        return Excel::download(new AnggaranRealisasiExport($projectId), $fileName);
    }

}
