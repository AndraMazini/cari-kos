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
        // Ini adalah tabel "Jembatan" antara Kos dan Fasilitas
        Schema::create('boarding_house_facilities', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel boarding_houses
            $table->foreignId('boarding_house_id')->constrained('boarding_houses')->cascadeOnDelete();
            // Relasi ke tabel facilities
            $table->foreignId('facility_id')->constrained('facilities')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_house_facilities');
    }
};