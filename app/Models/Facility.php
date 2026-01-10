<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name', 'icon'];

    // Relasi ke BoardingHouse (Many to Many)
    public function boardingHouses()
    {
        return $this->belongsToMany(BoardingHouse::class, 'boarding_house_facilities');
    }
}