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

        // 2. Mulai Query
        $query = BoardingHouse::with(['city', 'facilities'])
                  ->withCount(['rooms' => function ($query) {
                      $query->where('is_available', true); 
                  }])
                  ->withAvg('reviews', 'rating'); // Hitung rata-rata rating review

        // 3. Filter Pencarian (Keyword)
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

        // 4. Filter Kota
        // Kita standarisasi menggunakan 'city_id' agar konsisten
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // 5. Filter Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 6. Sorting
        if ($request->filled('sort')) {
            if ($request->sort == 'lowest') {
                $query->orderBy('price_start_from', 'asc');
            } elseif ($request->sort == 'highest') {
                $query->orderBy('price_start_from', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // 7. Ambil Data dengan Pagination (8 per halaman)
        $kosList = $query->paginate(8);

        return view('home', compact('kosList', 'cities'));
    }

    public function show($slug)
    {
        // Ambil data kos beserta review dan usernya untuk detail page
        $kos = BoardingHouse::where('slug', $slug)
                ->with(['city', 'rooms', 'facilities', 'user', 'reviews.user'])
                ->firstOrFail();

        return view('kos.show', compact('kos'));
    }
}