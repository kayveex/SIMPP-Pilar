<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialRequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MaterialItemsController extends Controller
{
    // Create a new material item from certain material (view)
    public function createMaterialItem($id) {
        $material = Material::findOrFail($id);
        return view('pages.materials.add-table', compact('material'));
    }

    // Display the detail of a material item
    public function showMaterialItem($id) {
        $item = MaterialRequestItem::findOrFail($id);
        $material = Material::findOrFail($item->material_id);

        return view('pages.materials.view-table', compact('item', 'material'));
    }
    
    // Store a new material item
    public function storeMaterialItem(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required',
            'price_per_unit' => 'required|numeric|min:0',
            'required_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $material = Material::findOrFail($id);

        DB::beginTransaction();

        try {
            $itemForMaterial = MaterialRequestItem::create([
                'item_name' => $request->item_name,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'price_per_unit' => $request->price_per_unit,
                // Total price is calculated as quantity * price per unit
                'total_price' => $request->quantity * $request->price_per_unit,
                
                'required_date' => $request->required_date,
                'notes' => $request->notes,
                'material_id' => $material->material_id, // Set the foreign key
            ]);
            DB::commit();

            // use helper
            create_notification(
                'Item Material Baru',
                Auth::user()->name . ' telah menambahkan item material baru: ' . $itemForMaterial->item_name,
                'success',
                Auth::id()
            );

            return redirect()->route('material.edit', $id)->with('success', 'Item material berhasil ditambahkan.');


        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan item material: ' . $th->getMessage()]);
        }
    }

    // Edit a material item (view)
    public function editMaterialItem($id) {
        $item = MaterialRequestItem::findOrFail($id);
        $material = Material::findOrFail($item->material_id);

        return view('pages.materials.edit-table', compact('item', 'material'));

    }

    // Patch update a material item
    public function updateMaterialItem(Request $request, $id) {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required',
            'received_quantity' => 'nullable|numeric|min:0',
            'price_per_unit' => 'required|numeric|min:0',
            'required_date' => 'nullable|date',
            'received_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $materialItem = MaterialRequestItem::findOrFail($id);

            $materialItem->update(
                [
                    'item_name' => $request->item_name,
                    'quantity' => $request->quantity,
                    'unit' => $request->unit,
                    'received_quantity' => $request->received_quantity,
                    'price_per_unit' => $request->price_per_unit,
                    'total_price' => $request->quantity * $request->price_per_unit, // Recalculate total price
                    'required_date' => $request->required_date,
                    'received_date' => $request->received_date,
                    'notes' => $request->notes,
                ]
            );

            DB::commit();

            // use helper
            create_notification(
                'Item Material Diperbarui',
                Auth::user()->name . ' telah memperbarui item material: ' . $materialItem->item_name,
                'success',
                Auth::id()
            );

            return redirect()->route('material.edit', $materialItem->material_id)->with('success', 'Item material berhasil diperbarui.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui item material: ' . $th->getMessage()]);
        }



    }

    // Delete a material item
    public function deleteMaterialItem($id) {
        $item = MaterialRequestItem::findOrFail($id);
        $materialId = $item->material_id; // Get the material_id before deleting

        DB::beginTransaction();

        try {
            $item->delete();
            DB::commit();

            // use helper
            create_notification(
                'Item Material Dihapus',
                Auth::user()->name . ' telah menghapus item material: ' . $item->item_name,
                'warning',
                Auth::id()
            );

            return redirect()->route('material.edit', $materialId)->with('success', 'Item material berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus item material: ' . $th->getMessage()]);
        }
    }
}
