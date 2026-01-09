<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // 1. Menampilkan Halaman Form Booking
    public function create($slug, Room $room)
    {
        $kos = BoardingHouse::where('slug', $slug)->firstOrFail();
        return view('booking.create', compact('kos', 'room'));
    }

    // 2. Menyimpan Data Transaksi Baru
    public function store(Request $request, $slug, Room $room)
    {
        $request->validate([
            'start_date'     => 'required|date',
            'duration'       => 'required|integer|min:1|max:12',
            'payment_method' => 'required|string',
        ]);

        // Hitung total harga
        $totalAmount = $room->price_per_month * $request->duration;

        // Simpan Transaksi
        $transaction = Transaction::create([
            'code'           => 'TRX-' . mt_rand(10000, 99999),
            'user_id'        => Auth::id() ?? 1, // Default user ID 1 (karena belum login)
            'room_id'        => $room->id,
            'start_date'     => $request->start_date,
            'duration'       => $request->duration,
            'total_amount'   => $totalAmount,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
        ]);

        return redirect()->route('booking.payment', $transaction->code);
    }

    // 3. Menampilkan Halaman Pembayaran / Status
    public function payment($code)
    {
        $transaction = Transaction::with(['room.boardingHouse', 'user'])
                        ->where('code', $code)
                        ->firstOrFail();

        return view('booking.payment', compact('transaction'));
    }

    // 4. Memproses Upload Bukti Pembayaran
    public function update(Request $request, $code)
    {
        $transaction = Transaction::where('code', $code)->firstOrFail();

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            
            $transaction->update([
                'payment_proof' => $path,
                'status' => 'paid' // Ubah status jadi paid (menunggu konfirmasi admin)
            ]);
        }

        return redirect()->route('booking.payment', $transaction->code)
            ->with('success', 'Bukti pembayaran berhasil dikirim!');
    }

    // 5. Menampilkan Riwayat Transaksi User (BARU)
    public function history()
    {
        // Ambil transaksi milik user yang sedang login (User ID 1 untuk testing)
        $userId = Auth::id() ?? 1;

        $transactions = Transaction::with(['room.boardingHouse'])
                        ->where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('booking.history', compact('transactions'));
    }
}