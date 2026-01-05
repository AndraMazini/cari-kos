<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request, $boardingHouse)
    {
        Transaction::create([
            'user_id' => Auth::id(),
            'boarding_house_id' => $boardingHouse,
            'status' => 'pending',
            'total_price' => 0,
        ]);

        return redirect()->back()
            ->with('success', 'Booking berhasil dibuat!');
    }
}
