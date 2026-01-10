<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\BoardingHouse;
use App\Models\City;

class AdminController extends Controller
{
    /**
     * Dashboard Utama Admin (Statistik)
     */
    public function dashboard()
    {
        $stats = [
            'total_kos' => BoardingHouse::count(),
            'total_cities' => City::count(),
            'total_transactions' => Transaction::count(),
            'total_users' => User::count(),
            'revenue' => Transaction::where('status', 'approved')->sum('total_amount'),
        ];

        $recentTransactions = Transaction::with(['user', 'room.boardingHouse'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentTransactions'));
    }

    /**
     * Daftar Semua Transaksi
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'room.boardingHouse'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Menyetujui Pembayaran
     */
    public function approve(Transaction $transaction)
    {
        $transaction->update(['status' => 'approved']);
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    /**
     * Menolak Pembayaran
     */
    public function reject(Transaction $transaction)
    {
        $transaction->update(['status' => 'rejected']);
        return back()->with('error', 'Pembayaran ditolak.');
    }
}