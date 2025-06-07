<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('report_lists', function (Blueprint $table) {
            $table->id('report_id')->primary();
            $table->unsignedBigInteger('phase_id');

            $table->string('report_title');
            $table->enum('report_type', ['harian', 'mingguan', 'bulanan', 'kendala', 'penyelesaian'])->default('harian'); 
            $table->text('activity')->nullable();
            $table->text('trouble')->nullable();
            $table->text('solution')->nullable();
            $table->date('report_date')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('phase_id')->references('phase_id')->on('project_phases')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_list');
    }
};
