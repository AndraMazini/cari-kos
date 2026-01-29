<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Menyimpan ulasan baru dari penyewa
     */
    public function store(Request $request, $boardingHouseId)
    {
        // 1. Validasi Input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        // 2. Simpan ke Database
        Review::create([
            'user_id' => Auth::id(),
            'boarding_house_id' => $boardingHouseId, // Menggunakan ID yang sudah diperbaiki
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        // 3. Kembali dengan pesan sukses
        return back()->with('success', 'Ulasan kamu berhasil dikirim!');
    }
}