<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Halaman Form Booking
    public function create($slug, Room $room)
    {
        $kos = BoardingHouse::where('slug', $slug)->firstOrFail();
        return view('booking.create', compact('kos', 'room'));
    }

    // Proses Simpan Transaksi
    public function store(Request $request, $slug, Room $room)
    {
        $request->validate([
            'start_date'     => 'required|date|after_or_equal:today',
            'duration'       => 'required|integer|min:1|max:12',
            // Validasi metode pembayaran yang diizinkan
            'payment_method' => 'required|in:BCA,BRI,MANDIRI,DANA,GOPAY', 
        ]);

        $kos = BoardingHouse::where('slug', $slug)->firstOrFail();
        
        // Hitung total harga
        $totalAmount = $room->price_per_month * $request->duration;

        // Buat Kode Transaksi Unik (TRX-ANGKAACAK)
        $code = 'TRX-' . mt_rand(10000, 99999);

        $transaction = Transaction::create([
            'code'              => $code,
            'user_id'           => Auth::id(),
            'room_id'           => $room->id,
            'start_date'        => $request->start_date,
            'duration'          => $request->duration,
            'total_amount'      => $totalAmount,
            'payment_method'    => $request->payment_method, // Simpan Pilihan User
            'status'            => 'pending',
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('booking.payment', $transaction->code);
    }

    // Halaman Pembayaran & Upload Bukti
    public function payment($code)
    {
        $transaction = Transaction::where('code', $code)
                        ->with(['user', 'room.boardingHouse'])
                        ->firstOrFail();

        return view('booking.payment', compact('transaction'));
    }

    // Proses Upload Bukti Bayar
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
                'status'        => 'paid' // Ubah status jadi 'paid' (menunggu verifikasi admin)
            ]);
        }

        return redirect()->route('booking.history')->with('success', 'Bukti pembayaran berhasil diupload! Tunggu konfirmasi admin.');
    }

    // Halaman Riwayat Booking
    public function history()
    {
        $transactions = Transaction::with(['room.boardingHouse'])
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->get();

        return view('booking.history', compact('transactions'));
    }
}