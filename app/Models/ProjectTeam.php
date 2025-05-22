<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    use HasFactory;

    protected $table = 'project_team';
    protected $primaryKey = 'team_id';
    
    protected $fillable = [
        'project_id',
        'user_id',
        'role_description',
        'assigned_date',
        'removed_date',
        'is_active',
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'removed_date' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}