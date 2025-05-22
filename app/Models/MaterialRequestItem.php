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
        'request_id',
        'material_id',
        'quantity',
        'unit',
        'required_date',
        'status',
        'received_quantity',
        'received_date',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'received_quantity' => 'decimal:2',
        'required_date' => 'date',
        'received_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function materialRequest()
    {
        return $this->belongsTo(MaterialRequest::class, 'request_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}