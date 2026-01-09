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
        Schema::create('transactions', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique();
    $table->foreignId('user_id')->constrained(); // Penyewa
    $table->foreignId('room_id')->constrained(); // Kamar
    $table->date('start_date');
    $table->integer('duration'); // Bulan
    $table->integer('total_amount');
    $table->enum('status', ['pending', 'paid', 'approved', 'rejected'])->default('pending');
    $table->string('payment_proof')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
