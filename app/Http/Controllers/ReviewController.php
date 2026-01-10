<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\Transaction;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $slug)
    {
        // 1. Validasi Input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $kos = BoardingHouse::where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        // 2. Cek Validasi: User harus pernah transaksi 'approved' (lunas) di kos ini
        // Kita cek apakah ada transaksi milik user ini, yang statusnya approved,
        // dan room-nya milik boarding_house_id yang sedang dilihat.
        $hasTransaction = Transaction::where('user_id', $user->id)
                            ->where('status', 'approved') 
                            ->whereHas('room', function($query) use ($kos) {
                                $query->where('boarding_house_id', $kos->id);
                            })
                            ->exists();

        if (!$hasTransaction) {
            return back()->with('error', 'Maaf, Anda harus pernah menyewa (transaksi lunas) di sini untuk memberikan ulasan.');
        }

        // 3. Cek Duplikasi: Satu user cuma boleh review 1x di kos yang sama
        $existingReview = Review::where('user_id', $user->id)
                            ->where('boarding_house_id', $kos->id)
                            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk kos ini sebelumnya.');
        }

        // 4. Simpan Review
        Review::create([
            'user_id' => $user->id,
            'boarding_house_id' => $kos->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}