<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    
    protected $fillable = [
        'project_id',
        'phase_id',
        'task_name',
        'description',
        'assignee_id',
        'start_date',
        'due_date',
        'completed_date',
        'status',
        'priority',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'completed_date' => 'date',
        'priority' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function phase()
    {
        return $this->belongsTo(ProjectPhase::class, 'phase_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Helper methods for task priority
    public function isHighPriority()
    {
        return $this->priority === 1;
    }

    public function isMediumPriority()
    {
        return $this->priority === 2;
    }

    public function isLowPriority()
    {
        return $this->priority === 3;
    }

    // Helper methods for task status
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCanceled()
    {
        return $this->status === 'canceled';
    }
}