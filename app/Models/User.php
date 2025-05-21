<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Available roles in the system
     */
    const ROLE_TEKNIKAL = 'Divisi Teknikal';
    const ROLE_PURCHASING = 'Divisi Purchasing';
    const ROLE_ADMINISTRASI = 'Divisi Administrasi';
    const ROLE_FINANCE = 'Divisi Finance';
    const ROLE_DIREKTUR = 'Direktur';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user has a specific role
     *
     * @param string $roleName
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role === $roleName;
    }
    
    /**
     * Check if user is from technical division
     */
    public function isTeknikal(): bool
    {
        return $this->role === self::ROLE_TEKNIKAL;
    }
    
    /**
     * Check if user is from purchasing division
     */
    public function isPurchasing(): bool
    {
        return $this->role === self::ROLE_PURCHASING;
    }
    
    /**
     * Check if user is from admin division
     */
    public function isAdministrasi(): bool
    {
        return $this->role === self::ROLE_ADMINISTRASI;
    }
    
    /**
     * Check if user is from finance division
     */
    public function isFinance(): bool
    {
        return $this->role === self::ROLE_FINANCE;
    }
    
    /**
     * Check if user is the director
     */
    public function isDirektur(): bool
    {
        return $this->role === self::ROLE_DIREKTUR;
    }

    /**
     * Get the projects created by the user.
     */
    public function createdProjects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    /**
     * Get the project teams the user belongs to.
     */
    public function teams()
    {
        return $this->hasMany(ProjectTeam::class, 'user_id');
    }

    /**
     * Get the tasks assigned to the user.
     */
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assignee_id');
    }

    /**
     * Get the material requests created by the user.
     */
    public function materialRequests()
    {
        return $this->hasMany(MaterialRequest::class, 'requested_by');
    }

    /**
     * Get the project expenses created by the user.
     */
    public function expenses()
    {
        return $this->hasMany(ProjectExpense::class, 'created_by');
    }

    /**
     * Get the progress reports submitted by the user.
     */
    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class, 'submitted_by');
    }
}
