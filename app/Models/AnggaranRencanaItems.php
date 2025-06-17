<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranRencanaItems extends Model
{
    protected $table = 'anggaran_rencana_items';
    protected $primaryKey = 'anggaran_rencana_item_id';
    protected $fillable = [
        'anggaran_rencana_id',
        'item_name',
        'quantity',
        'unit',
        'price_per_unit',
        'total_price',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function anggaranRencana()
    {
        return $this->belongsTo(AnggaranRencana::class, 'anggaran_rencana_id');
    }
    
}
