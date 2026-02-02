<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    // Menggunakan guarded kosong agar semua kolom bisa diisi (mass assignment)
    protected $guarded = [];

    // Relasi ke Kota
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relasi ke Pemilik (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kamar-kamar yang tersedia di kos ini
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Relasi ke Fasilitas (Many-to-Many)
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'boarding_house_facilities');
    }

    // Relasi ke Review dari penyewa
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi ke Foto-foto tambahan (Gallery)
     * SOLUSI: Agar fitur slider di show.blade.php bisa memanggil $kos->images
     */
    public function images()
    {
        return $this->hasMany(BoardingHouseImage::class);
    }

    /**
     * Helper: Menghitung rata-rata rating untuk tampilan IMK
     * Agar user bisa melihat bintang kos di halaman utama
     */
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }
}