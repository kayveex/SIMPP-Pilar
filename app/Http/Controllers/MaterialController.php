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
     * Show the material status page.
     *
     * @return \Illuminate\View\View
     */
    public function status()
    {
        $materialRequests = MaterialRequest::with(['project', 'requester', 'approver'])->get();
        return view('pages.material_status', compact('materialRequests'));
    }

    /**
     * Show the material add page.
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        $projects = Project::where('status', '!=', 'selesai')
            ->get();
        $materials = Material::all();

        return view('pages.material_add', compact('projects', 'materials'));
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