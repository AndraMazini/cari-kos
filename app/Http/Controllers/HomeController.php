<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\City;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all();

        $kosList = BoardingHouse::with(['city', 'facilities'])
            ->withAvg('reviews', 'rating')
            ->withCount(['rooms' => function ($query) {
                $query->where('is_available', true);
            }])
            // Filter Search (Nama, Alamat, atau Kota)
            ->when($request->search, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('address', 'like', '%' . $search . '%')
                      ->orWhereHas('city', function($c) use ($search) {
                          $c->where('name', 'like', '%' . $search . '%');
                      });
                });
            })
            // Filter City
            ->when($request->city_id, function ($query, $cityId) {
                $query->where('city_id', $cityId);
            })
            // Filter Category
            ->when($request->category, function ($query, $category) {
                $query->where('category', $category);
            })
            // Sorting Logic
            ->when($request->sort, function ($query, $sort) {
                if ($sort === 'lowest') {
                    $query->orderBy('price_start_from', 'asc');
                } elseif ($sort === 'highest') {
                    $query->orderBy('price_start_from', 'desc');
                }
            }, function ($query) {
                // Default sorting jika tidak ada request sort
                $query->orderBy('created_at', 'desc');
            })
            ->paginate(8)
            ->withQueryString(); // Menjaga filter tetap ada saat pindah halaman (pagination)

        return view('home', compact('kosList', 'cities'));
    }

    public function show($slug)
    {
        $kos = BoardingHouse::where('slug', $slug)
            ->with(['city', 'rooms', 'facilities', 'user', 'reviews.user', 'images'])
            ->firstOrFail();

        return view('kos.show', compact('kos'));
    }
}