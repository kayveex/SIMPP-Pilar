<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLog extends Model
{
    use HasFactory;

    protected $table = 'approval_logs';
    protected $primaryKey = 'log_id';
    public $timestamps = false;
    
    protected $fillable = [
        'project_id',
        'approval_type',
        'approved_by',
        'approval_date',
        'notes',
    ];

    protected $casts = [
        'approval_date' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}