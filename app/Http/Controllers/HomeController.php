<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\City;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data kota untuk dropdown filter
        $cities = City::all();

        // 2. Mulai Query dengan Eager Loading & Average Rating
        // withAvg akan otomatis membuat properti 'reviews_avg_rating'
        $query = BoardingHouse::with(['city', 'facilities'])
                  ->withAvg('reviews', 'rating')
                  ->withCount(['rooms' => function ($query) {
                      $query->where('is_available', true); // Hitung cuma kamar yang tersedia
                  }]);

        // 3. Logika Pencarian (Keyword)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%')
                  ->orWhereHas('city', function($c) use ($search) {
                      $c->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // 4. Logika Filter Kota
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // 5. Logika Filter Kategori (Putra/Putri/Campur)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 6. Logika Sorting Harga
        if ($request->filled('sort')) {
            if ($request->sort == 'lowest') {
                $query->orderBy('price_start_from', 'asc');
            } elseif ($request->sort == 'highest') {
                $query->orderBy('price_start_from', 'desc');
            }
        } else {
            // Default urutkan dari yang terbaru
            $query->orderBy('created_at', 'desc');
        }

        // 7. Eksekusi dengan Pagination (Opsional, tapi disarankan untuk IT student)
        $kosList = $query->paginate(8);

        return view('home', compact('kosList', 'cities'));
    }

    public function show($slug)
    {
        // Menambahkan 'images' dan 'reviews.user' agar slider dan list ulasan tidak error
        $kos = BoardingHouse::where('slug', $slug)
                ->with(['city', 'rooms', 'facilities', 'user', 'reviews.user', 'images'])
                ->firstOrFail();

        return view('kos.show', compact('kos'));
    }
}