<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dengan eager loading relasi agar efisien
        $query = BoardingHouse::with(['city', 'rooms']);

        // Logika Pencarian: Jika ada input 'search'
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')       // Cari nama kos
                  ->orWhere('address', 'like', '%' . $search . '%')  // Cari alamat
                  ->orWhereHas('city', function($c) use ($search) {
                      $c->where('name', 'like', '%' . $search . '%'); // Cari nama kota
                  });
            });
        }

        // Ambil hasil data
        $kosList = $query->get();

        return view('home', compact('kosList'));
    }

    public function show($slug)
    {
        $kos = BoardingHouse::where('slug', $slug)
                ->with(['city', 'rooms', 'facilities', 'user'])
                ->firstOrFail();

        return view('kos.show', compact('kos'));
    }
}