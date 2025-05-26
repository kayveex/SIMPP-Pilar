<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    
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
        'director_approval',
        'technical_approval',
        'admin_approval',
        'purchasing_approval',
        'finance_approval',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'estimated_end_date' => 'date',
        'actual_end_date' => 'date',
        'budget' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'director_approval' => 'boolean',
        'technical_approval' => 'boolean',
        'admin_approval' => 'boolean',
        'purchasing_approval' => 'boolean',
        'finance_approval' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function phases()
    {
        return $this->hasMany(ProjectPhase::class, 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function team()
    {
        return $this->hasMany(ProjectTeam::class, 'project_id');
    }

    public function materialRequests()
    {
        return $this->hasMany(MaterialRequest::class, 'project_id');
    }

    public function expenses()
    {
        return $this->hasMany(ProjectExpense::class, 'project_id');
    }

    public function payments()
    {
        return $this->hasMany(ProjectPayment::class, 'project_id');
    }

    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class, 'project_id');
    }

    public function documents()
    {
        return $this->hasMany(ProjectDocument::class, 'project_id');
    }

    public function approvalLogs()
    {
        return $this->hasMany(ApprovalLog::class, 'project_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'project_id');
    }

    public function finalReport()
    {
        return $this->hasOne(FinalProjectReport::class, 'project_id');
    }

    // Helper methods for project status
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
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