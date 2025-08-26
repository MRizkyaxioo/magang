<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPengaduController;
use App\Http\Controllers\HasilPengaduanController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthPengaduController;
use App\Http\Controllers\PengaduanController;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Middleware\RedirectIfNotPengadu;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login-pengadu');

// Register
Route::get('/register-pengadu', [AuthPengaduController::class, 'showRegisterForm'])->name('pengadu.register');
Route::post('/register-pengadu', [AuthPengaduController::class, 'register']);

// Login
Route::get('/login-pengadu', [AuthPengaduController::class, 'showLoginForm'])->name('pengadu.login');
Route::post('/login-pengadu', [AuthPengaduController::class, 'login']);

// Logout
Route::post('/logout-pengadu', [AuthPengaduController::class, 'logout'])->name('pengadu.logout');

// Dashboard (contoh middleware)
// Route::get('/dashboard-pengadu', function () {
//     return 'Selamat datang di dashboard pengadu!';
// })->middleware('auth:pengadu');

// Route::get('/dashboard-pengadu', function () {
//     return view('pengadu.dashboard');
// })->middleware(RedirectIfNotPengadu::class)
//   ->name('pengadu.dashboard');

  Route::get('/dashboard-pengadu', [App\Http\Controllers\DashboardPengaduController::class, 'index'])
    ->middleware(RedirectIfNotPengadu::class)
    ->name('pengadu.dashboard');

    Route::middleware(RedirectIfNotPengadu::class)->group(function () {
    Route::get('/pengaduan/create', [App\Http\Controllers\HasilPengaduanController::class, 'create'])
        ->name('pengadu.pengaduan.create');

    Route::post('/pengaduan/store', [App\Http\Controllers\HasilPengaduanController::class, 'store'])
        ->name('pengadu.pengaduan.store');
});

Route::middleware(RedirectIfNotPengadu::class)->group(function () {
    Route::get('/riwayat', [DashboardPengaduController::class, 'history'])->name('pengadu.riwayat');
});



// login admin
Route::get('/login-admin', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login-admin', [AuthAdminController::class, 'login']);

// logout admin
Route::post('/logout-admin', [AuthAdminController::class, 'logout'])->name('admin.logout');

// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboard');
// })->middleware(RedirectIfNotAdmin::class)
//   ->name('admin.dashboard');

Route::get('/form-pengadu', [HasilPengaduanController::class, 'create'])
    ->middleware(RedirectIfNotPengadu::class)
    ->name('pengadu.form');


Route::middleware(RedirectIfNotAdmin::class)->group(function () {
    Route::get('/kategori', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/kategori/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/kategori', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/kategori/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/kategori/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/kategori/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
});

Route::middleware(RedirectIfNotAdmin::class)->group(function () {
Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/{id}/status', [DashboardAdminController::class, 'updateStatus'])->name('admin.updateStatus');
Route::get('/admin/{id}', [DashboardAdminController::class, 'show'])->name('admin.show');
});


