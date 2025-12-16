<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KendaraanController;

Route::middleware('admin')->prefix('admin')->group(function () {

    // KENDARAAN
    Route::get('/kendaraan', [KendaraanController::class, 'index'])
        ->name('admin.kendaraan.index');

    Route::get('/kendaraan/create', [KendaraanController::class, 'create'])
        ->name('admin.kendaraan.create');

    Route::post('/kendaraan', [KendaraanController::class, 'store'])
        ->name('admin.kendaraan.store');

    // EDIT
    Route::get('/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])
        ->name('admin.kendaraan.edit');

    // UPDATE
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update'])
        ->name('admin.kendaraan.update');

    // DELETE
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])
        ->name('admin.kendaraan.destroy');
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

