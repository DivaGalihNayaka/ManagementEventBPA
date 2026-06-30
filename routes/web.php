<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;

// 1. Redirect halaman utama langsung ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Memuat rute bawaan otentikasi Breeze
require __DIR__.'/auth.php';

// 3. Rute Kustom Login & Register
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// 4. Rute Kustom Logout
Route::get('/keluar', [LoginController::class, 'logout'])->name('keluar');

// 5. Rute Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// 6. Rute Event
Route::middleware('auth')->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/calendar', [EventController::class, 'calendar'])->name('events.calendar');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    
    // Rute Baru: Untuk Menghapus Event
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

// 7. Rute Profil Bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});