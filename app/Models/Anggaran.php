<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'anggaran';
    protected $primaryKey = 'anggaran_id';
    public $incrementing = true;

    protected $fillable = [
        'project_id',
        'title',
        'total_budget',
    ];

    protected $casts = [
        'total_budget' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function items()
    {
        return $this->hasMany(AnggaranItems::class, 'anggaran_id');
    }
}
