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
        Schema::create('anggaran_realisasi_items', function (Blueprint $table) {
            $table->id('anggaran_realisasi_item_id')->primary();
            $table->unsignedBigInteger('anggaran_realisasi_id'); // Foreign key to anggaran_rencana table
            $table->string('item_name'); // Name of the budget item
            $table->decimal('quantity', 15, 2);
            $table->string('unit')->default('pcs'); // Unit of measurement (e.g., pcs, kg, liter)
            $table->bigInteger('price_per_unit')->nullable(); //harga per unit, bisa dikosongkan jika tidak ada
            $table->decimal('total_price', 15, 2)->nullable(); //total harga, bisa dikosongkan jika tidak ada

            // Foreign key for anggaran_realisasi_items
            $table->foreign('anggaran_realisasi_id')->references('anggaran_realisasi_id')->on('anggaran_realisasi')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_realisasi_items');
    }
};
