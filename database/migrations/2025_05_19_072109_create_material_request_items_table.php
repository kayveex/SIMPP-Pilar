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
            $table->string('item_name'); //nama item, misal: "Paralon PVC"
            $table->decimal('quantity', 15, 2);
            $table->enum('unit', ['pcs', 'kg', 'm', 'cm', 'liter', 'set'])->default('pcs'); //unit of measurement
            $table->date('required_date')->nullable(); //tanggal item dibutuhkan, bisa dikosongkan jika tidak ada batas waktu
            $table->decimal('received_quantity', 15, 2)->nullable();
            $table->date('received_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign key for material_request_items
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('material_id')->on('materials')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_request_items');
    }
};