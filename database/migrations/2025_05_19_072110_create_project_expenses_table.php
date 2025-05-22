<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_expenses', function (Blueprint $table) {
            $table->bigIncrements('expense_id');
            $table->unsignedBigInteger('project_id');
            $table->string('expense_type');
            $table->decimal('amount', 15, 2);
            $table->date('expense_date');
            $table->text('description')->nullable();
            $table->string('receipt_reference')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->cascadeOnDelete();
            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_expenses');
    }
};