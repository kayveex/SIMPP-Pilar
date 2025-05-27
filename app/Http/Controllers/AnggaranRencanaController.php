<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Material;
use App\Models\ProjectExpense;
use Illuminate\Http\Request;

class AnggaranRencanaController extends Controller
{
    /**
     * Display the anggaran rencana page with project details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $project = Project::findOrFail($id);
        
        // Get materials that might be needed for planning
        $materials = Material::all();
        
        // Get any existing budget plans if they exist
        $plannedExpenses = ProjectExpense::where('project_id', $id)
            ->where('expense_type', 'rencana')
            ->get();
        
        // Group planned expenses by category for display
        $expensesByCategory = $plannedExpenses->groupBy('description');
        
        return view('pages.anggaran_rencana', compact(
            'project',
            'materials',
            'expensesByCategory'
        ));
    }

    /**
     * Store a new budget plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePlan(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.amount' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit' => 'required|string',
            'items.*.category' => 'required|string',
        ]);
        
        // Process and save budget plan items
        foreach ($validated['items'] as $item) {
            ProjectExpense::create([
                'project_id' => $id,
                'expense_type' => 'rencana',
                'description' => $item['description'],
                'amount' => $item['amount'] * $item['quantity'],
                'expense_date' => now(),
                'created_by' => auth()->id(),
                // Store additional data as JSON if needed
                'notes' => json_encode([
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'category' => $item['category'],
                    'unit_price' => $item['amount']
                ])
            ]);
        }
        
        // Update project budget based on plan
        $totalBudget = ProjectExpense::where('project_id', $id)
            ->where('expense_type', 'rencana')
            ->sum('amount');
        
        $project->budget = $totalBudget;
        $project->save();
        
        return redirect()->route('anggaran.rencana', $id)
            ->with('success', 'Rencana anggaran berhasil disimpan!');
    }

    /**
     * Generate PDF report for anggaran rencana.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function generatePdf($id)
    {
        $project = Project::with(['expenses'])->findOrFail($id);
        
        // This would require a PDF generation library like DomPDF
        // For now, we'll just return a message
        
        return redirect()->back()->with('info', 'Fitur PDF sedang dalam pengembangan.');
    }
}