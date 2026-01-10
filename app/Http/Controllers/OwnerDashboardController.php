<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\Transaction;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Total Kos
        $totalKos = BoardingHouse::where('user_id', $userId)->count();

        // 2. Total Kamar & Ketersediaan
        // Ambil semua kos milik user
        $kosIds = BoardingHouse::where('user_id', $userId)->pluck('id');
        
        $totalRooms = Room::whereIn('boarding_house_id', $kosIds)->count();
        $filledRooms = Room::whereIn('boarding_house_id', $kosIds)->where('is_available', false)->count();
        $emptyRooms = Room::whereIn('boarding_house_id', $kosIds)->where('is_available', true)->count();

        // 3. Total Pendapatan (Hanya dari transaksi yang 'approved')
        $revenue = Transaction::whereHas('room.boardingHouse', function($q) use ($userId) {
                        $q->where('user_id', $userId);
                    })
                    ->where('status', 'approved')
                    ->sum('total_amount');

        // 4. Transaksi Terbaru (5 teratas)
        $recentTransactions = Transaction::with(['user', 'room.boardingHouse'])
                    ->whereHas('room.boardingHouse', function($q) use ($userId) {
                        $q->where('user_id', $userId);
                    })
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

        return view('owner.dashboard', compact(
            'totalKos', 
            'totalRooms', 
            'filledRooms', 
            'emptyRooms', 
            'revenue', 
            'recentTransactions'
        ));
    }
}