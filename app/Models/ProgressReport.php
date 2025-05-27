<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    use HasFactory;

    protected $table = 'progress_reports';
    protected $primaryKey = 'report_id';
    
    protected $fillable = [
        'project_id',
        'report_date',
        'progress_percentage',
        'description',
        'challenges',
        'solutions',
        'next_steps',
        'submitted_by',
    ];

    protected $casts = [
        'report_date' => 'date',
        'progress_percentage' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}