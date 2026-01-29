<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\City;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OwnerKosController extends Controller
{
    // 1. Menampilkan daftar kos milik user yang login
    public function index()
    {
        // Hanya ambil kos yang user_id nya sama dengan user yang login
        $kosList = BoardingHouse::with('city')->where('user_id', Auth::id())->get();
        return view('owner.kos.index', compact('kosList'));
    }

    // 2. Menampilkan Form Tambah Kos
    public function create()
    {
        $cities = City::all();
        $facilities = Facility::all();
        return view('owner.kos.create', compact('cities', 'facilities'));
    }

    // 3. Proses Simpan Kos Baru
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'city_id'          => 'required|exists:cities,id',
            'category'         => 'required|in:Putra,Putri,Campur',
            'price_start_from' => 'required|numeric',
            'address'          => 'required|string',
            'description'      => 'required|string',
            'thumbnail'        => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
            'facilities'       => 'array'
        ]);

        // Upload Gambar ke folder public/storage/thumbnails
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Buat Slug Unik (nama-kos-acak)
        $slug = Str::slug($request->name) . '-' . Str::random(5);

        // Simpan ke Database BoardingHouse
        $kos = BoardingHouse::create([
            'name'             => $request->name,
            'slug'             => $slug,
            'user_id'          => Auth::id(), // Otomatis pakai ID user yang login
            'city_id'          => $request->city_id,
            'category'         => $request->category,
            'price_start_from' => $request->price_start_from,
            'address'          => $request->address,
            'description'      => $request->description,
            'thumbnail'        => $thumbnailPath,
        ]);

        // Simpan Relasi Fasilitas (Many-to-Many)
        if ($request->has('facilities')) {
            $kos->facilities()->attach($request->facilities);
        }

        return redirect()->route('owner.kos.index')->with('success', 'Kos berhasil ditambahkan!');
    }

    // --- BAGIAN YANG DIPERBAIKI (DITAMBAHKAN) ---

    public function edit($id)
    {
        $kos = BoardingHouse::where('user_id', Auth::id())->findOrFail($id);
        $cities = City::all();
        $facilities = Facility::all();
        return view('owner.kos.edit', compact('kos', 'cities', 'facilities'));
    }

    public function update(Request $request, $id)
    {
        $kos = BoardingHouse::where('user_id', Auth::id())->findOrFail($id);
        
        // Update data dasar
        $kos->update($request->except('thumbnail', 'facilities'));

        // Update thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            if ($kos->thumbnail) Storage::disk('public')->delete($kos->thumbnail);
            $kos->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            $kos->save();
        }

        // Update fasilitas
        if ($request->has('facilities')) {
            $kos->facilities()->sync($request->facilities);
        }

        return redirect()->route('owner.kos.index')->with('success', 'Kos berhasil diupdate!');
    }

    public function destroy($id)
    {
        // 1. Cari data kosnya
        $kos = BoardingHouse::where('user_id', Auth::id())->findOrFail($id);
        
        // 2. Hapus data secara berjenjang (Cascade Manual)
        // Karena ada Foreign Key Constraint, kita hapus dari level paling bawah
        foreach ($kos->rooms as $room) {
            // Hapus transaksi yang nempel di tiap kamar
            $room->transactions()->delete();
            // Hapus kamarnya
            $room->delete();
        }

        // 3. Lepas relasi fasilitas di pivot table
        $kos->facilities()->detach();

        // 4. Hapus file gambar di storage
        if ($kos->thumbnail) {
            Storage::disk('public')->delete($kos->thumbnail);
        }

        // 5. Terakhir, hapus data kos-nya
        $kos->delete();

        return redirect()->route('owner.kos.index')->with('success', 'Kos dan semua data terkait berhasil dihapus!');
    }
}