<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boarding_houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address');
            $table->integer('price_start_from');
            $table->string('category');
            
            // Explicitly pointing to 'cities' and 'users' table
            // Tanpa onDelete agar data aman dari penghapusan otomatis
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('user_id')->constrained('users');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boarding_houses');
    }
};