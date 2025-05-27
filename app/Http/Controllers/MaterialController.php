<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialRequest;
use App\Models\MaterialRequestItem;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Display the materials page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $materials = Material::all();
        return view('pages.material', compact('materials'));
    }

    /**
     * Show the form for creating a new material.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.materials.create');
    }

    /**
     * Store a newly created material in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_code' => 'required|string|unique:materials,material_code',
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
        ]);

        Material::create($validated);

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil ditambahkan.');
    }

    /**
     * Display the specified material.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('pages.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified material.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('pages.materials.edit', compact('material'));
    }

    /**
     * Update the specified material in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        
        $validated = $request->validate([
            'material_code' => 'required|string|unique:materials,material_code,'.$id.',material_id',
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $material->update($validated);

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil diperbarui.');
    }

    /**
     * Remove the specified material from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil dihapus.');
    }

    /**
     * Display a listing of material requests.
     *
     * @return \Illuminate\View\View
     */
    public function requests()
    {
        $materialRequests = MaterialRequest::with('project', 'requester')->get();
        $projects = Project::all();
        $materials = Material::all();
        
        return view('pages.materials.requests', compact('materialRequests', 'projects', 'materials'));
    }

    /**
     * Store a new material request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'notes' => 'nullable|string',
            'materials' => 'required|array',
            'materials.*.material_id' => 'required|exists:materials,material_id',
            'materials.*.quantity' => 'required|numeric|min:1',
            'materials.*.unit' => 'required|string',
            'materials.*.required_date' => 'nullable|date',
        ]);

        $materialRequest = MaterialRequest::create([
            'project_id' => $validated['project_id'],
            'requested_by' => Auth::id(),
            'notes' => $validated['notes'] ?? null,
            'requested_at' => now(),
        ]);

        foreach ($validated['materials'] as $item) {
            MaterialRequestItem::create([
                'request_id' => $materialRequest->request_id,
                'material_id' => $item['material_id'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'required_date' => $item['required_date'] ?? null,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('materials.requests')
            ->with('success', 'Permintaan material berhasil disubmit!');
    }

    /**
     * Approve a material request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveRequest(Request $request, $id)
    {
        $materialRequest = MaterialRequest::findOrFail($id);
        $materialRequest->update([
            'approval_status' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('materials.requests')
            ->with('success', 'Permintaan material berhasil disetujui!');
    }
}