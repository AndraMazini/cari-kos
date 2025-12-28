<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $guarded = []; // Izinkan semua kolom diisi

    // Relasi ke Kota
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relasi ke Pemilik
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kamar
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Relasi ke Fasilitas (Many to Many)
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'boarding_house_facilities');
    }
}