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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Relasi ke user yang mereview
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relasi ke kos yang direview
            $table->foreignId('boarding_house_id')->constrained()->onDelete('cascade');
            // Rating bintang 1-5
            $table->integer('rating');
            // Komentar ulasan
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};