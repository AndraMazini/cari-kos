<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;

class HomeController extends Controller
{
    public function index()
{
    // Ambil data kos beserta relasinya (biar tidak query berulang-ulang/N+1 problem)
    $kosList = BoardingHouse::with(['city', 'rooms'])->get();

    return view('home', compact('kosList'));
}
}