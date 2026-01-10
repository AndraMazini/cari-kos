<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // Tambahkan ini agar create() di seeder berfungsi
    protected $guarded = []; 

    public function boardingHouses()
    {
        return $this->hasMany(BoardingHouse::class);
    }
}