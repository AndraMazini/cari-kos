<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // --- REGISTER ---
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', // Pastikan form punya name="password_confirmation"
        ]);

        // FITUR BARU: Generate Username Otomatis
        // Contoh: Nama "Rafly Alfazari" -> Username "raflyalfazari123"
        $generatedUsername = str_replace(' ', '', strtolower($request->name)) . rand(100, 999);

        User::create([
            'name' => $request->name,
            'username' => $generatedUsername, // <-- Masukkan username otomatis
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pencari', // Default role untuk user baru
        ]);

        // Langsung Login setelah daftar
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('success', 'Akun berhasil dibuat!');
        }

        return redirect()->route('login');
    }

    // --- LOGIN ---
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Berhasil Login!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil Logout.');
    }
}