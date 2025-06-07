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
        Schema::create('report_files', function (Blueprint $table) {
            $table->id('report_file_id')->primary();
            $table->unsignedBigInteger('report_id'); // Foreign Key to report_lists
            $table->string('file_name'); // Name of the file
            $table->string('file_type'); // Type of the file (e.g., pdf, docx, etc.)
            $table->string('file_path'); // Path to the file in storage
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('report_id')->references('report_id')->on('report_lists')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_files');
    }
};
