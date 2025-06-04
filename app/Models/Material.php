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
        'material_title',
        'material_notes',
        'vendor',
        'client_name',
        'purchasing_approval',
        'purchasing_approval_date',
        'estimated_arrival_date',
        'actual_arrival_date',
        'approval_status',
        'invoice',
        'created_by',
        'project_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function requestItems()
    {
        return $this->hasMany(MaterialRequestItem::class, 'material_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}