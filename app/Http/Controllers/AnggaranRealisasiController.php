<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectExpense;
use App\Models\ProjectPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggaranRealisasiController extends Controller
{
    /**
     * Display the anggaran realisasi page with project details.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $project = Project::with(['expenses', 'payments'])->findOrFail($id);
        
        // Group expenses by category for reporting
        $expensesByCategory = $project->expenses->groupBy('expense_type');
        
        // Calculate financial summaries
        $totalExpenses = $project->expenses->sum('amount');
        $totalPayments = $project->payments->sum('amount');
        $balance = $totalPayments - $totalExpenses;
        
        // Get expense details with grouped categories
        $expenseDetails = [];
        foreach ($expensesByCategory as $category => $expenses) {
            $expenseDetails[$category] = [
                'total' => $expenses->sum('amount'),
                'items' => $expenses
            ];
        }
        
        return view('pages.anggaran_realisasi', compact(
            'project', 
            'expenseDetails', 
            'totalExpenses', 
            'totalPayments', 
            'balance'
        ));
    }

    /**
     * Generate PDF report for anggaran realisasi.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function generatePdf($id)
    {
        $project = Project::with(['expenses', 'payments'])->findOrFail($id);
        
        // This would require a PDF generation library like DomPDF
        // For now, we'll just return a message
        
        return redirect()->back()->with('info', 'Fitur PDF sedang dalam pengembangan.');
    }
    
    /**
     * Export realisasi data to Excel.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function exportExcel($id)
    {
        $project = Project::with(['expenses', 'payments'])->findOrFail($id);
        
        // This would require an Excel library like Maatwebsite Excel
        // For now, we'll just return a message
        
        return redirect()->back()->with('info', 'Fitur Excel sedang dalam pengembangan.');
    }
}