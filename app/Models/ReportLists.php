<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportLists extends Model
{
    use HasFactory;

    protected $table = 'report_lists';
    protected $primaryKey = 'report_id';
    public $incrementing = true;

    protected $fillable = [
        'phase_id',
        'report_title',
        'report_type',
        'activity',
        'trouble',
        'solution',
        'report_date',
    ];

    protected $casts = [
        'report_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Buat relasi dengan model ProjectPhase
    public function phase()
    {
        return $this->belongsTo(ProjectPhase::class, 'phase_id');
    }

    // Buat relasi dengan model ReportFiles
    public function files()
    {
        return $this->hasMany(ReportFiles::class, 'report_id');
    }


}
