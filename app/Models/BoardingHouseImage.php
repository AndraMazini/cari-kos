<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouseImage extends Model
{
    use HasFactory;

    // Menentukan kolom yang boleh diisi secara massal
    protected $fillable = [
        'boarding_house_id', // INI YANG BENAR, sesuaikan dengan kolom di migration kamu
        'image_path',
    ];

    /**
     * Relasi balik ke BoardingHouse (Induk Kos)
     * Satu foto ini dimiliki oleh satu Kos
     */
    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}