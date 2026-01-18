<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranRealisasiItems extends Model
{
    protected $table = 'anggaran_realisasi_items';
    protected $primaryKey = 'anggaran_realisasi_item_id';
    protected $fillable = [
        'anggaran_realisasi_id',
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

    public function anggaranRealisasi()
    {
        return $this->belongsTo(AnggaranRealisasi::class, 'anggaran_realisasi_id', 'anggaran_realisasi_id');
    }
}
