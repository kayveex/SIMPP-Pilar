<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFiles extends Model
{
    use HasFactory;

    protected $table = 'report_files';
    protected $primaryKey = 'report_file_id';
    public $incrementing = true;

    protected $fillable = [
        'report_file_id',
        'report_id',
        'file_name',
        'file_path',
        'file_type',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function report()
    {
        return $this->belongsTo(ReportLists::class, 'report_id');
    }
}
