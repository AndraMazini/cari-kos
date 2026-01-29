<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    // Mengizinkan pengisian data secara massal (mass assignment)
    protected $fillable = [
        'user_id', 
        'boarding_house_id', 
        'rating', 
        'komentar'
    ];

    /**
     * Relasi ke BoardingHouse (Kos)
     * Menghubungkan ulasan ini ke data kos yang bersangkutan
     */
    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id');
    }

    /**
     * Relasi ke User (Penyewa)
     * Menghubungkan ulasan ke identitas penyewa yang menulisnya
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}   