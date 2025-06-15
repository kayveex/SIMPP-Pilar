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
        Schema::create('notification', function (Blueprint $table) {
            $table->id('notif_id')->primary();
            $table->unsignedBigInteger('user_id'); // Foreign Key to users
            $table->string('title'); // Title of the notification
            $table->text('message'); // Message content of the notification
            $table->boolean('is_read')->default(false); // Read status of the notification
            $table->string('type')->nullable(); // Type of notification (e.g., info, warning, error)
            $table->string('url')->nullable(); // URL to redirect when notification is clicked
            // set target role
            $table->string('target_role')->nullable(); // Role that this notification is targeted to
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
