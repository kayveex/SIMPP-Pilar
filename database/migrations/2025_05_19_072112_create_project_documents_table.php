<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_documents', function (Blueprint $table) {
            $table->id('document_id')->primary();
            $table->unsignedBigInteger('project_id');
            $table->string('document_name');
            $table->string('document_type');
            $table->string('file_path');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('uploaded_by');
            $table->timestamp('upload_date')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('project_id')->references('project_id')->on('projects')->cascadeOnDelete();
            $table->foreign('uploaded_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_documents');
    }
};