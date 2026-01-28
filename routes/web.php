<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KendaraanController as AdminKendaraanController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\User\KendaraanController as UserKendaraanController;
use App\Http\Controllers\User\PesananController;

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // ===== ADMIN AUTH =====
    Route::get('/login', [AuthController::class, 'showAdminLogin'])
        ->name('admin.login');

    Route::post('/login', [AuthController::class, 'adminLogin'])
        ->name('admin.login.submit');

    Route::middleware('admin')->group(function () {

        // ✅ DASHBOARD
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        // ===== KENDARAAN =====
        Route::get('/kendaraan', [AdminKendaraanController::class, 'index'])
            ->name('admin.kendaraan.index');

        Route::get('/kendaraan/create', [AdminKendaraanController::class, 'create'])
            ->name('admin.kendaraan.create');

        Route::post('/kendaraan', [AdminKendaraanController::class, 'store'])
            ->name('admin.kendaraan.store');

        Route::get('/kendaraan/{id}/edit', [AdminKendaraanController::class, 'edit'])
            ->name('admin.kendaraan.edit');

        Route::put('/kendaraan/{id}', [AdminKendaraanController::class, 'update'])
            ->name('admin.kendaraan.update');

        Route::delete('/kendaraan/{id}', [AdminKendaraanController::class, 'destroy'])
            ->name('admin.kendaraan.destroy');

        // ===== PESANAN =====
        Route::get('/pesanan', [AdminPesananController::class, 'index'])
            ->name('admin.pesanan.index');

        Route::get('/pesanan/{id}', [AdminPesananController::class, 'show'])
            ->name('admin.pesanan.show');

        Route::put('/pesanan/{id}', [AdminPesananController::class, 'update'])
            ->name('admin.pesanan.update');
    });
});

/*
|--------------------------------------------------------------------------
| USER AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kendaraan', [UserKendaraanController::class, 'index'])
    ->name('kendaraan.index');

Route::get('/kendaraan/{id}', [UserKendaraanController::class, 'show'])
    ->name('kendaraan.show');

/*
|--------------------------------------------------------------------------
| USER AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // ===== BOOKING SYSTEM =====
    Route::post('/kendaraan/{id}/booking', [BookingController::class, 'store'])
        ->name('booking.store');
    
    Route::get('/booking/success/{id}', [BookingController::class, 'success'])
        ->name('booking.success');
    
    // ===== PESANAN USER (Daftar & Detail) =====
    Route::get('/pesanan', [PesananController::class, 'index'])
        ->name('user.pesanan.index');
    
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])
        ->name('user.pesanan.show');
    
    // ===== PESANAN PREVIEW (Old Flow - Optional) =====
    Route::post('/pesanan/preview', [PesananController::class, 'preview'])
        ->name('pesanan.preview');
    
    Route::post('/pesanan/store', [PesananController::class, 'store'])
        ->name('pesanan.store');
});
