<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerKosController; // <-- Jangan lupa import ini
use Illuminate\Support\Facades\Route;

// --- PUBLIC ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kos/{slug}', [HomeController::class, 'show'])->name('kos.show');

// --- AUTH ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- BOOKING ---
Route::middleware('auth')->controller(TransactionController::class)->group(function () {
    Route::get('/kos/{slug}/book/{room}', 'create')->name('booking.create');
    Route::post('/kos/{slug}/book/{room}', 'store')->name('booking.store');
    Route::get('/payment/{code}', 'payment')->name('booking.payment');
    Route::put('/payment/{code}', 'update')->name('booking.update');
    Route::get('/my-bookings', 'history')->name('booking.history');
});

// --- ADMIN (VERIFIKASI BAYAR) ---
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/transactions', [AdminController::class, 'index'])->name('admin.transactions.index');
    Route::post('/transactions/{transaction}/approve', [AdminController::class, 'approve'])->name('admin.transactions.approve');
    Route::post('/transactions/{transaction}/reject', [AdminController::class, 'reject'])->name('admin.transactions.reject');
});

// --- OWNER (KELOLA KOS) - BAGIAN BARU ---
Route::prefix('owner')->middleware('auth')->group(function () {
    Route::get('/my-kos', [OwnerKosController::class, 'index'])->name('owner.kos.index');
    Route::get('/my-kos/create', [OwnerKosController::class, 'create'])->name('owner.kos.create');
    Route::post('/my-kos', [OwnerKosController::class, 'store'])->name('owner.kos.store');
});