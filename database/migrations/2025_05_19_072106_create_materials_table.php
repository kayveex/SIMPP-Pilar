<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id('material_id')->primary();
            $table->string('material_title'); //Misal: "Pengajuan Material Proyek A"
            $table->text('material_notes')->nullable(); // Catatan pengajuan material, bisa dikosongkan
            $table->string('vendor')->nullable(); // Vendor yang menyediakan material, bisa dikosongkan
            $table->string('client_name');

            // Approval oleh tim purchasing
            $table->boolean('purchasing_approval')->default(false);
            $table->date('purchasing_approval_date')->nullable();

            // estimated arrival date
            $table->date('estimated_arrival_date')->nullable(); // Tanggal perkiraan kedatangan material
            $table->date('actual_arrival_date')->nullable(); // Tanggal kedatangan material yang sebenarnya

            // Approval status
            $table->enum('approval_status', ['diproses', 'dipesan', 'ditolak', 'diterima', 'disetujui'])->default('diproses');

            // Bukti Invoice
            $table->string('invoice')->nullable(); 

            $table->timestamps(); //created_at, updated_at

            // Foreign key for user who created the material
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
            // Foreign key for project_id
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('project_id')->on('projects')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};