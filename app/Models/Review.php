<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'boarding_house_id',
        'rating',
        'comment'
    ];

    // Review milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Review milik satu Kos
    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}