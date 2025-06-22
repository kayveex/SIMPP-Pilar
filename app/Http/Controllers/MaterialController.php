<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialRequest;
use App\Models\MaterialRequestItem;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class MaterialController extends Controller
{
    /**
     * Display the materials page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Check authorization - only Technical and Purchasing can access materials
        $user = Auth::user();
        if (!$user->isTeknikal() && !$user->isPurchasing()) {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses untuk halaman ini');
        }

        $query = Material::with('project');

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $query->where(function ($q) use ($search) {
                $q->whereHas('project', function ($subQuery) use ($search) {
                    $subQuery->whereRaw('LOWER(project_name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('CAST(project_id AS TEXT) LIKE ?', ["%{$search}%"]);
                });
            });
        }

        if ($request->filled('approval_status')) {
            $query->where('approval_status', $request->approval_status);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $materials = $query->paginate(5)->withQueryString();

        return view('pages.materials.index', compact('materials'));
    }


    /**
     * Show the material status page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */

    //Edit - Edit page for material
    public function editPage($id)
    {
        // Check authorization - only Technical and Purchasing can access materials
        $user = Auth::user();
        if (!$user->isTeknikal() && !$user->isPurchasing()) {
            return redirect(to: '/home')->with('error', 'Anda tidak memiliki akses untuk halaman ini');
        }

        $material = Material::findOrFail($id);

        // Make $materialRequests available to the view, ascending by created_at
        $materialRequests = MaterialRequestItem::where('material_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Get current user role for conditional display
        $userRole = Auth::user()->role;
        
        return view('pages.materials.edit', compact('material', 'materialRequests', 'userRole'));
    }

    /**
     * Show the material view page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function viewPage($id)
    {
        // Check authorization - only Technical and Purchasing can access materials
        $user = Auth::user();
        if (!$user->isTeknikal() && !$user->isPurchasing()) {
            return redirect('/home')->with('error', 'Anda tidak memiliki akses untuk halaman ini');
        }

        $material = Material::findOrFail($id);

        // Make $materialRequests available to the view, ascending by created_at
        $materialRequests = MaterialRequestItem::where('material_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Get current user role for conditional display
        $userRole = Auth::user()->role;
        
        return view('pages.materials.view', compact('material', 'materialRequests', 'userRole'));
    }


    /**
     * Show the material create page.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $projects = Project::all();
        return view('pages.materials.create', compact('projects'));
    }

    // store a material 
    public function storeMaterial(Request $request) 
    {
        $request->validate([
            'material_title' => 'required|string|max:255|min:3',
            'client_name' => 'required|string|max:255|min:3',
        ]);

        DB::beginTransaction();

        try {
            $material = Material::create([
                'material_title' => $request->material_title,
                'client_name' => $request->client_name,
                'created_by' => Auth::id(),
                'project_id' => $request->project_id,
                'created_at' => Carbon::now(),
            ]);

            DB::commit(); // Tambahkan ini

            // use helper
            create_notification(
                'Material Diajukan',
                Auth::user()->name . ' telah mengajukan material: ' . $material->material_title,
                'success',
                Auth::id()
            );

            // Redirect to the edit page for the newly created material
            return redirect()->route('material.edit', $material->material_id)
                ->with('success', 'Material berhasil diajukan. Silakan tambahkan item material.');
            // return redirect()->route('material.index')->with('success', 'Material berhasil diajukan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan material: ' . $th->getMessage()]);
        }
    }

    // edit PATCH a material
    public function updateMaterial(Request $request, $id) 
    {
        $request->validate([
            'material_title' =>  'required|string|max:255|min:3',
            'material_notes' => 'nullable|string|max:1000',
            'vendor' => 'nullable|string|max:255',
            'invoice' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'estimated_arrival_date' => 'nullable|date',
            'actual_arrival_date' => 'nullable|date',
            'approval_status' => 'nullable|in:diproses,dipesan,disetujui,ditolak,diterima',
        ]);

        DB::beginTransaction();
        
        try {
            $material = Material::findOrFail($id);

            $data = $request->only([
                'material_title', 'material_notes', 'vendor',
                'estimated_arrival_date', 'actual_arrival_date', 'approval_status'
            ]);

            if ($request->hasFile('invoice')) {
                if ($material->invoice && Storage::disk('public')->exists($material->invoice)) {
                    Storage::disk('public')->delete($material->invoice);
                }
                $data['invoice'] = $request->file('invoice')->store('invoices', 'public');
            }

            $material->update($data);
            DB::commit(); // Commit the transaction if everything is successful
            // use helper
            create_notification(
                'Material Diperbarui',
                Auth::user()->name . ' telah memperbarui material: ' . $material->material_title,
                'success',
                Auth::id()
            );

            return redirect()->route('material.index')->with('success', 'Material berhasil diperbarui.');

        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback the transaction on error
            dd($th);
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui material: ' . $th->getMessage()]);
        }



    }

    // Edit PATCH - Material Approval
    public function updateApproval($id) {
        if (Auth::user()->role === 'Divisi Purchasing' || Auth::user()->role === 'Super Admin') {
            $material = Material::findOrFail($id);
            $material->update([
                'purchasing_approval' => true,
                'purchasing_approval_date' => Carbon::now(),
                'approval_status' => 'disetujui',
            ]);

            // use helper
            create_notification(
                'Material Disetujui',
                Auth::user()->name . ' telah menyetujui material: ' . $material->material_title,
                'success',
                Auth::id()
            );

            return redirect()->route('material.index')->with('success', 'Material berhasil disetujui.');
        }
    }

    // Edit PATCH - Delete Material Approval
    public function deleteApproval($id) {
        if (Auth::user()->role === 'Divisi Purchasing' || Auth::user()->role === 'Super Admin') {
            $material = Material::findOrFail($id);
            $material->update([
                'purchasing_approval' => false,
                'purchasing_approval_date' => null,
                'approval_status' => 'ditolak',
            ]);

            // use helper
            create_notification(
                'Material Ditolak',
                Auth::user()->name . ' telah menolak material: ' . $material->material_title,
                'warning',
                Auth::id()
            );

            return redirect()->route('material.index')->with('success', 'Persetujuan material berhasil dihapus.');
        }
    }

    // Delete a material
    public function deleteMaterial($id) 
    {
        $material = Material::findOrFail($id);

        if (!is_null($material->invoice) && Storage::disk('public')->exists($material->invoice)) {
            Storage::disk('public')->delete($material->invoice);
        }

        $material->delete();

        // use helper
        create_notification(
            'Material Dihapus',
            Auth::user()->name . ' telah menghapus material: ' . $material->material_title,
            'warning',
            Auth::id()
        );

        return redirect()->route('material.index')->with('success', 'Material berhasil dihapus.');
    }

}