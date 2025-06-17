<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranRealisasi extends Model
{
    protected $table = 'anggaran_realisasi';
    protected $primaryKey = 'anggaran_realisasi_id';
    protected $fillable = [
        'project_id',
        'title',
        'total_budget',
    ];  

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function items()
    {
        return $this->hasMany(AnggaranRealisasiItems::class, 'anggaran_realisasi_id');
    }
}
