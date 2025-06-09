<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id')->primary();
            $table->string('project_type')->enum('onsite','bengkel'); // 'onsite', 'bengkel';
            $table->string('project_name'); //required
            $table->text('description')->nullable(); //required->create
            $table->string('person_in_charge'); //required->create
            $table->text('location')->nullable(); //required->create
            $table->string('client_name')->nullable(); //required->create
            $table->string('client_contact')->nullable();
            $table->date('start_date');
            $table->date('estimated_end_date');
            $table->date('actual_end_date')->nullable();
            $table->enum('status', ['belum_dimulai','berlangsung','tertunda','selesai','dibatalkan']); //belum_dimulai, berlangsung, tertunda, selesai, dibatalkan
            // Fitur tambahan, untuk menjumlahkan biaya proyek dari fitur anggaran
            $table->decimal('budget', 15, 2)->nullable();
            $table->decimal('actual_cost', 15, 2)->nullable();
            // Fitur tambahan, untuk menyimpan informasi tentang persetujuan proyek
            // Persetujuan Direktur
            $table->boolean('director_approval')->default(false);
            $table->date('director_approval_date')->nullable();
            // Persetujuan Tim Technical
            $table->boolean('technical_approval')->default(false);
            $table->date('technical_approval_date')->nullable();
            // Persetujuan Tim Administrasi
            $table->boolean('admin_approval')->default(false);
            $table->date('admin_approval_date')->nullable();
            // Persetujuan Tim Purchasing
            $table->boolean('purchasing_approval')->default(false);
            $table->date('purchasing_approval_date')->nullable();
            // Persetujuan Tim Finance
            $table->boolean('finance_approval')->default(false);
            $table->date('finance_approval_date')->nullable();
            // Fitur menyimpan persentase progres proyek
            $table->integer('progress_percentage')->default(0)->nullable(); // 0-100%

            // Fitur tambahan, untuk menyimpan informasi tentang siapa yang membuat  & kapan proyek dibuat
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            // Bagian Foreign key 
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};