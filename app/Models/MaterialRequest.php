<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    use HasFactory;

    protected $table = 'material_requests';
    protected $primaryKey = 'request_id';
    
    protected $fillable = [
        'project_id',
        'requested_by',
        'approval_status',
        'approved_by',
        'approved_at',
        'notes',
    ];

    protected $casts = [
        'approval_status' => 'boolean',
        'approved_at' => 'datetime',
        'requested_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items()
    {
        return $this->hasMany(MaterialRequestItem::class, 'request_id');
    }
}