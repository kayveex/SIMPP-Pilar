<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_request_items', function (Blueprint $table) {
            $table->id('item_id')->primary();
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('quantity', 15, 2);
            $table->string('unit');
            $table->date('required_date')->nullable();
            $table->string('status')->nullable();
            $table->decimal('received_quantity', 15, 2)->nullable();
            $table->date('received_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('request_id')->references('request_id')->on('material_requests')->cascadeOnDelete();
            $table->foreign('material_id')->references('material_id')->on('materials')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_request_items');
    }
};