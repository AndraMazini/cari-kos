<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = []; // Izinkan mass assignment

    // Relasi: Kamar milik satu Kos (BoardingHouse)
    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    // Relasi: Kamar punya banyak Transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}