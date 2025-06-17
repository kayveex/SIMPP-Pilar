<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggaranRencana extends Model
{
    protected $table = 'anggaran_rencana';
    protected $primaryKey = 'anggaran_rencana_id';
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
        return $this->hasMany(AnggaranRencanaItems::class, 'anggaran_rencana_id');
    }

}
