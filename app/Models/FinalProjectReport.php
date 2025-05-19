<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalProjectReport extends Model
{
    use HasFactory;

    protected $table = 'final_project_reports';
    protected $primaryKey = 'report_id';
    
    protected $fillable = [
        'project_id',
        'completion_date',
        'total_cost',
        'final_status',
        'performance_summary',
        'technical_challenges',
        'solutions_implemented',
        'lessons_learned',
        'recommendations',
        'prepared_by',
        'approval_status',
        'approved_by',
        'approval_date',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'total_cost' => 'decimal:2',
        'approval_status' => 'boolean',
        'approval_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function preparer()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}