<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminController extends Controller
{
    // Halaman Daftar Transaksi Masuk
    public function index()
    {
        // Ambil semua transaksi, urutkan yang terbaru
        $transactions = Transaction::with(['user', 'room.boardingHouse'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    // Proses Konfirmasi Pembayaran (Approve/Reject)
    public function approve(Transaction $transaction)
    {
        $transaction->update(['status' => 'approved']);
        return back()->with('success', 'Transaksi berhasil disetujui!');
    }

    public function reject(Transaction $transaction)
    {
        $transaction->update(['status' => 'rejected']);
        return back()->with('error', 'Transaksi ditolak.');
    }
}