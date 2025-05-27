<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectExpense;
use App\Models\ProjectPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggaranController extends Controller
{
    /**
     * Display the anggaran (budget) main page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::with(['expenses', 'payments'])->get();
        
        // Calculate financial summaries for each project
        foreach ($projects as $project) {
            $project->totalExpenses = $project->expenses->sum('amount');
            $project->totalPayments = $project->payments->sum('amount');
            $project->balance = $project->totalPayments - $project->totalExpenses;
        }
        
        return view('pages.anggaran', compact('projects'));
    }

    /**
     * Display the expenses listing.
     *
     * @return \Illuminate\View\View
     */
    public function expenses()
    {
        $expenses = ProjectExpense::with('project')->get();
        $projects = Project::all();
        
        return view('pages.budget.expenses', compact('expenses', 'projects'));
    }

    /**
     * Store a new project expense.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeExpense(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'expense_type' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'receipt_reference' => 'nullable|string|max:100',
        ]);

        $expenseData = $validated;
        $expenseData['created_by'] = Auth::id();

        ProjectExpense::create($expenseData);

        // Update project actual cost
        $project = Project::find($validated['project_id']);
        $totalExpenses = ProjectExpense::where('project_id', $project->project_id)->sum('amount');
        $project->actual_cost = $totalExpenses;
        $project->save();

        return redirect()->route('anggaran.expenses')
            ->with('success', 'Pengeluaran berhasil dicatat!');
    }

    /**
     * Display the payments listing.
     *
     * @return \Illuminate\View\View
     */
    public function payments()
    {
        $payments = ProjectPayment::with('project')->get();
        $projects = Project::all();
        
        return view('pages.budget.payments', compact('payments', 'projects'));
    }

    /**
     * Store a new project payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePayment(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:100',
            'reference_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $paymentData = $validated;
        $paymentData['recorded_by'] = Auth::id();
        $paymentData['status'] = 'recorded';

        ProjectPayment::create($paymentData);

        return redirect()->route('anggaran.payments')
            ->with('success', 'Pembayaran berhasil dicatat!');
    }

    /**
     * Generate budget report for a specific project.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function projectReport($id)
    {
        $project = Project::with(['expenses', 'payments'])->findOrFail($id);
        
        // Calculate financial summary
        $project->totalExpenses = $project->expenses->sum('amount');
        $project->totalPayments = $project->payments->sum('amount');
        $project->balance = $project->totalPayments - $project->totalExpenses;
        
        // Group expenses by category
        $expensesByCategory = $project->expenses->groupBy('expense_type');
        $expenseSummary = [];
        
        foreach ($expensesByCategory as $category => $expenses) {
            $expenseSummary[$category] = $expenses->sum('amount');
        }
        
        return view('pages.budget.report', compact('project', 'expenseSummary'));
    }
}