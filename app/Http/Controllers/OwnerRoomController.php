<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class OwnerRoomController extends Controller
{
    // Helper untuk memastikan Kos milik User yang login
    private function getKos($slug) {
        return BoardingHouse::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    // 1. Tampilkan Daftar Kamar di Kos tertentu
    public function index($slug)
    {
        $kos = $this->getKos($slug);
        $rooms = $kos->rooms; // Mengambil relasi rooms
        
        return view('owner.rooms.index', compact('kos', 'rooms'));
    }

    // 2. Form Tambah Kamar
    public function create($slug)
    {
        $kos = $this->getKos($slug);
        return view('owner.rooms.create', compact('kos'));
    }

    // 3. Simpan Kamar Baru
    public function store(Request $request, $slug)
    {
        $kos = $this->getKos($slug);

        $request->validate([
            'name'            => 'required|string|max:255', // Contoh: "Kamar Tipe A"
            'size'            => 'required|string|max:255', // Contoh: "3x4 Meter"
            'price_per_month' => 'required|numeric|min:0',
        ]);

        Room::create([
            'boarding_house_id' => $kos->id,
            'name'              => $request->name,
            'size'              => $request->size,
            'price_per_month'   => $request->price_per_month,
            'is_available'      => true, // Default tersedia
        ]);

        return redirect()->route('owner.rooms.index', $slug)
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    // 4. Form Edit Kamar
    public function edit($slug, Room $room)
    {
        $kos = $this->getKos($slug);
        
        // Pastikan kamar benar-benar milik kos ini
        if($room->boarding_house_id != $kos->id) {
            abort(404);
        }

        return view('owner.rooms.edit', compact('kos', 'room'));
    }

    // 5. Update Data Kamar
    public function update(Request $request, $slug, Room $room)
    {
        $kos = $this->getKos($slug);
        
        if($room->boarding_house_id != $kos->id) { abort(404); }

        $request->validate([
            'name'            => 'required|string|max:255',
            'size'            => 'required|string|max:255',
            'price_per_month' => 'required|numeric|min:0',
            'is_available'    => 'required|boolean',
        ]);

        $room->update([
            'name'            => $request->name,
            'size'            => $request->size,
            'price_per_month' => $request->price_per_month,
            'is_available'    => $request->is_available,
        ]);

        return redirect()->route('owner.rooms.index', $slug)
            ->with('success', 'Data kamar berhasil diperbarui!');
    }

    // 6. Hapus Kamar
    public function destroy($slug, Room $room)
    {
        $kos = $this->getKos($slug);
        if($room->boarding_house_id != $kos->id) { abort(404); }

        $room->delete();

        return redirect()->route('owner.rooms.index', $slug)
            ->with('success', 'Kamar berhasil dihapus.');
    }
}