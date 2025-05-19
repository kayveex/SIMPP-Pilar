<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('final_project_reports', function (Blueprint $table) {
            $table->bigIncrements('report_id');
            $table->unsignedBigInteger('project_id');
            $table->date('completion_date')->nullable();
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->string('final_status')->nullable();
            $table->text('performance_summary')->nullable();
            $table->text('technical_challenges')->nullable();
            $table->text('solutions_implemented')->nullable();
            $table->text('lessons_learned')->nullable();
            $table->text('recommendations')->nullable();
            $table->unsignedBigInteger('prepared_by')->nullable();
            $table->boolean('approval_status')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approval_date')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->cascadeOnDelete();
            $table->foreign('prepared_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('final_project_reports');
    }
};