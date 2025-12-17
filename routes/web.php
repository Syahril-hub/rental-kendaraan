<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\PesananController;


Route::middleware('admin')->prefix('admin')->group(function () {

    // ======================
    // KENDARAAN
    // ======================
    Route::get('/kendaraan', [KendaraanController::class, 'index'])
        ->name('admin.kendaraan.index');

    Route::get('/kendaraan/create', [KendaraanController::class, 'create'])
        ->name('admin.kendaraan.create');

    Route::post('/kendaraan', [KendaraanController::class, 'store'])
        ->name('admin.kendaraan.store');

    Route::get('/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])
        ->name('admin.kendaraan.edit');

    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update'])
        ->name('admin.kendaraan.update');

    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])
        ->name('admin.kendaraan.destroy');


    // ======================
    // PESANAN (ADMIN)
    // ======================
    Route::get('/pesanan', [PesananController::class, 'index'])
        ->name('admin.pesanan.index');

    Route::get('/pesanan/{id}', [PesananController::class, 'show'])
        ->name('admin.pesanan.show');

    Route::put('/pesanan/{id}', [PesananController::class, 'update'])
        ->name('admin.pesanan.update');
});



Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/admin/dashboard', function () {
    return "Halo Admin";
})->middleware('admin');

