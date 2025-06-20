<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\AnggaranRencana;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggaranRencanaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $project;
    protected $budgetItems;

    public function __construct($projectId)
    {
        $this->project = Project::findOrFail($projectId);
        
        // Collect all budget items from Rencana only
        $this->budgetItems = collect();
        
        // Add Rencana Anggaran items
        $anggaranRencana = AnggaranRencana::where('project_id', $projectId)
            ->with('items')
            ->orderBy('created_at', 'asc')
            ->get();
            
        foreach($anggaranRencana as $rencana) {
            foreach($rencana->items as $item) {
                $this->budgetItems->push([
                    'category' => $rencana->title,
                    'project' => $this->project,
                    'item' => $item
                ]);
            }
        }
    }

    public function collection()
    {
        return $this->budgetItems;
    }

    public function map($row): array
    {
        return [
            $row['category'],
            $row['project']->project_name,
            $row['project']->client_name ?? '-',
            $row['item']->item_name,
            $row['item']->quantity,
            ucfirst($row['item']->unit),
            'Rp. ' . number_format($row['item']->price_per_unit, 0, ',', '.'),
            'Rp. ' . number_format($row['item']->total_price, 0, ',', '.'),
        ];
    }

    public function headings(): array
    {
        return [
            'Kategori Rencana',
            'Nama Proyek',
            'Nama Klien',
            'Nama Item',
            'Qty',
            'Satuan',
            'Harga Satuan',
            'Total Harga',
        ];
    }
}
