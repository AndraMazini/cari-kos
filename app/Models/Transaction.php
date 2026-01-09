<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Opsional: Tambahkan ini jika pakai factory
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Tambahkan baris ini untuk mengizinkan semua kolom diisi
    protected $guarded = [];

    // Relasi ke User (Penyewa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kamar
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}