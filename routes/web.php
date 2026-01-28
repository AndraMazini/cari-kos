<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMasterController;
use App\Http\Controllers\OwnerKosController;
use App\Http\Controllers\OwnerRoomController;
use App\Http\Controllers\TransactionController;

// --- Halaman Publik ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kos/{slug}', [HomeController::class, 'show'])->name('kos.show');

// --- Rute Guest (Login/Register) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

// --- Rute Authenticated (Sudah Login) ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- ADMIN AREA ---
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        // Dashboard Utama
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Manajemen Transaksi
        Route::get('/transactions', [AdminController::class, 'index'])->name('admin.transactions.index');
        Route::post('/transactions/{transaction}/approve', [AdminController::class, 'approve'])->name('admin.transactions.approve');
        Route::post('/transactions/{transaction}/reject', [AdminController::class, 'reject'])->name('admin.transactions.reject');

        // Data Master (Kota & Fasilitas)
        Route::get('/cities', [AdminMasterController::class, 'cities'])->name('admin.cities.index');
        Route::post('/cities', [AdminMasterController::class, 'storeCity'])->name('admin.cities.store');
        
        Route::get('/facilities', [AdminMasterController::class, 'facilities'])->name('admin.facilities.index');
        Route::post('/facilities', [AdminMasterController::class, 'storeFacility'])->name('admin.facilities.store');
    });

    // --- OWNER AREA (PEMILIK) ---
    Route::prefix('owner')->middleware('role:pemilik')->group(function () {
        
        // 1. MANAJEMEN KOS (LENGKAP CRUD)
        Route::get('/my-kos', [OwnerKosController::class, 'index'])->name('owner.kos.index');
        Route::get('/my-kos/create', [OwnerKosController::class, 'create'])->name('owner.kos.create');
        Route::post('/my-kos', [OwnerKosController::class, 'store'])->name('owner.kos.store');
        // Tambahan (Edit & Delete Kos):
        Route::get('/my-kos/{id}/edit', [OwnerKosController::class, 'edit'])->name('owner.kos.edit'); 
        Route::put('/my-kos/{id}', [OwnerKosController::class, 'update'])->name('owner.kos.update');
        Route::delete('/my-kos/{id}', [OwnerKosController::class, 'destroy'])->name('owner.kos.destroy');

        // 2. MANAJEMEN KAMAR (LENGKAP CRUD)
        // List & Create
        Route::get('/my-kos/{slug}/rooms', [OwnerRoomController::class, 'index'])->name('owner.rooms.index');
        Route::get('/my-kos/{slug}/rooms/create', [OwnerRoomController::class, 'create'])->name('owner.rooms.create');
        Route::post('/my-kos/{slug}/rooms', [OwnerRoomController::class, 'store'])->name('owner.rooms.store');
        
        // Tambahan (Edit & Delete Rooms) - INI YANG BIKIN ERROR TADI
        Route::get('/my-kos/{slug}/rooms/{room}/edit', [OwnerRoomController::class, 'edit'])->name('owner.rooms.edit');
        Route::put('/my-kos/{slug}/rooms/{room}', [OwnerRoomController::class, 'update'])->name('owner.rooms.update');
        Route::delete('/my-kos/{slug}/rooms/{room}', [OwnerRoomController::class, 'destroy'])->name('owner.rooms.destroy');
    });

    // --- USER AREA (Penyewa) ---
    Route::middleware('role:penyewa')->group(function () {
        Route::get('/kos/{slug}/book/{room}', [TransactionController::class, 'create'])->name('booking.create');
        Route::post('/kos/{slug}/book/{room}', [TransactionController::class, 'store'])->name('booking.store');
        Route::get('/payment/{code}', [TransactionController::class, 'payment'])->name('booking.payment');
        Route::put('/payment/{code}', [TransactionController::class, 'update'])->name('booking.update');
        Route::get('/my-bookings', [TransactionController::class, 'history'])->name('booking.history');
    });
});