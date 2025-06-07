<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRequestItem extends Model
{
    use HasFactory;

    protected $table = 'material_request_items';
    protected $primaryKey = 'item_id';
    
    protected $fillable = [
        'item_id',
        'item_name', // nama item, misal: "Paralon PVC"
        'quantity',
        'unit', // unit of measurement
        'price_per_unit', // harga per unit, bisa dikosongkan jika tidak ada
        'total_price', // total harga, bisa dikosongkan jika tidak ada
        'required_date', // tanggal item dibutuhkan, bisa dikosongkan jika tidak ada batas waktu
        'received_quantity',
        'received_date',
        'notes',
        'material_id', // Foreign key for material
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'received_quantity' => 'decimal:2',
        'required_date' => 'date',
        'received_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}