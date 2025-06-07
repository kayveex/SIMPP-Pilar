<?php

namespace App\Exports;

use App\Models\MaterialRequestItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MaterialItemsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $material;

    public function __construct($material)
    {
        $this->material = $material;
    }

    public function collection()
    {
        return $this->material->requestItems()->with('material.project')->get();
    }

    public function map($item): array
    {
        return [
            $item->material->material_title,
            $item->material->project->project_name ?? '-',
            $item->material->client_name ?? '-',
            $item->item_name,
            $item->quantity,
            ucfirst($item->unit),
            'Rp. ' . number_format($item->price_per_unit, 0, ',', '.'),
            'Rp. ' . number_format($item->total_price, 0, ',', '.'),
        ];
    }

    public function headings(): array
    {
        return [
            'Judul Material',
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
