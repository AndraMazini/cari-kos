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
        Schema::create('boarding_houses', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('city_id')->constrained()->cascadeOnDelete();
        $table->text('address');
        $table->string('category');
        $table->text('description');
        $table->integer('price_start_from');
        
        // --- BAGIAN INI YANG DIUBAH ---
        $table->string('thumbnail')->nullable(); // Tambahkan ->nullable()
        // ------------------------------
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_houses');
    }
};
