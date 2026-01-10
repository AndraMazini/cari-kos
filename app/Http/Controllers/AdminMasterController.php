<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Facility;
use Illuminate\Support\Str;

class AdminMasterController extends Controller
{
    // --- MANAJEMEN KOTA ---
    public function cities()
    {
        $cities = City::all();
        return view('admin.master.cities', compact('cities'));
    }

    public function storeCity(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:cities,name']);
        
        City::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        
        return back()->with('success', 'Kota berhasil ditambahkan');
    }

    // --- MANAJEMEN FASILITAS ---
    public function facilities()
    {
        $facilities = Facility::all();
        return view('admin.master.facilities', compact('facilities'));
    }

    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:facilities,name',
            'icon' => 'required|string' // Contoh: fa-solid fa-wifi
        ]);

        Facility::create([
            'name' => $request->name,
            'icon' => $request->icon
        ]);

        return back()->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function destroyFacility(Facility $facility)
    {
        $facility->delete();
        return back()->with('success', 'Fasilitas berhasil dihapus');
    }
}