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
        Schema::create('anggaran', function (Blueprint $table) {
            $table->id('anggaran_id')->primary();
            $table->unsignedBigInteger('project_id'); 
            $table->string('title');
            $table->bigInteger('total_budget')->default(0); // Total anggaran untuk proyek

            // Foreign key
            $table->foreign('project_id')->references('project_id')->on('projects')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran');
    }
};
