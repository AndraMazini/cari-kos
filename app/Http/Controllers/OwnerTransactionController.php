<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OwnerTransactionController extends Controller
{
    public function index()
    {
        // Ambil transaksi yang kamarnya berada di kos milik user yang sedang login
        $transactions = Transaction::with(['user', 'room.boardingHouse'])
            ->whereHas('room.boardingHouse', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.transactions.index', compact('transactions'));
    }
}