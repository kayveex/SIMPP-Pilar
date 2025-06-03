<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialRequest;
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
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Material::with('project');

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->whereHas('project', function ($q) use ($search) {
                $q->whereRaw('LOWER(project_name) LIKE ?', ["%{$search}%"]);
            });
        }

        if ($request->filled('approval_status')) {
            $status = $request->status;
            $query->where('approval_status', $status);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            // default urutan
            $query->orderBy('created_at', 'desc');
        }

        $materials = $query->paginate(5)->withQueryString();

        return view('pages.materials.index', compact('materials'));


    }

    /**
     * Show the material status page.
     *
     * @return \Illuminate\View\View
     */


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
            ]);

            DB::commit(); // Tambahkan ini
            return redirect()->route('material.index')->with('success', 'Material berhasil diajukan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan material: ' . $th->getMessage()]);
        }
    }


    /**
     * Show the material view page.
     *
     * @param  int|null  $id
     * @return \Illuminate\View\View
     */
    public function view($id = null)
    {
        // Logic to fetch material request details
        return view('pages.material_view');
    }

    /**
     * Show the material process page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function process($id)
    {
        // Logic to fetch material request details
        return view('pages.material_proses');
    }

    /**
     * Show the material approval page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function approval($id)
    {
        // Logic to fetch material request details
        return view('pages.material_persetujuan');
    }

    /**
     * Process a material approval request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processApproval(Request $request, $id)
    {
        // Process approval logic
        return redirect()->route('material.status')
            ->with('success', 'Material berhasil diproses!');
    }
}