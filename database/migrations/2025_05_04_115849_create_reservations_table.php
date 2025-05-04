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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['active','cancelled']);
            $table->timestamp('reservation_date');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
