<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Exports\MaterialItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class MaterialItemExportController extends Controller
{
    public function export(Material $material)
    {
        $fileName = 'material_' . $material->material_id . '_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new MaterialItemsExport($material), $fileName);
    }
}

