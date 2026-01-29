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
            
            // Menghubungkan ke penyewa yang memberi review
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Menghubungkan ke kos yang di-review
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            // Menambahkan kolom rating dan komentar
            $table->integer('rating');
            $table->text('komentar');
            
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