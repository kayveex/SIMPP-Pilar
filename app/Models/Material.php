<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'material_id';
    
    protected $fillable = [
        'material_code',
        'material_name',
        'description',
        'unit',
        'unit_price',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function requestItems()
    {
        return $this->hasMany(MaterialRequestItem::class, 'material_id');
    }
}