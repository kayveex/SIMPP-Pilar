<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranItems extends Model
{
    protected $table = 'anggaran_items';
    protected $primaryKey = 'anggaran_item_id';
    public $incrementing = true;

    protected $fillable = [
        'anggaran_id',
        'item_name',
        'quantity',
        'unit',
        'price_per_unit',
        'total_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price_per_unit' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'anggaran_id');
    }
    
}
