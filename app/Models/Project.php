<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    public $incrementing = true;
    
    protected $fillable = [
        'project_name',
        'project_type',
        'description',
        'person_in_charge',
        'location',
        'client_name',
        'client_contact',
        'start_date',
        'estimated_end_date',
        'actual_end_date',
        'status',
        'budget',
        'actual_cost',
        'progress_percentage',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'estimated_end_date' => 'date',
        'actual_end_date' => 'date',
        'budget' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke Material
    public function materials()
    {
        return $this->hasMany(Material::class, 'project_id');
    }

    public function phases()
    {
        return $this->hasMany(ProjectPhase::class, 'project_id');
    }

    public function documents()
    {
        return $this->hasMany(ProjectDocument::class, 'project_id');
    }







}