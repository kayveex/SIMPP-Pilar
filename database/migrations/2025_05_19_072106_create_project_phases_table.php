<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_phases', function (Blueprint $table) {
            $table->id('phase_id')->primary();
            $table->unsignedBigInteger('project_id');
            $table->string('phase_name');
            // Estimated start and end dates for the phase
            $table->date('estimated_start_date')->nullable();
            $table->date('estimated_end_date')->nullable();
            // Actual start and end dates for the phase
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();
            // $table->string('status')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_phases');
    }
};