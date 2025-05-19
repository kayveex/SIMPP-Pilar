<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDocument extends Model
{
    use HasFactory;

    protected $table = 'project_documents';
    protected $primaryKey = 'document_id';
    
    protected $fillable = [
        'project_id',
        'document_name',
        'document_type',
        'file_path',
        'description',
        'uploaded_by',
    ];

    protected $casts = [
        'upload_date' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}