<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthPengaduController;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Middleware\RedirectIfNotPengadu;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

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

Route::get('/dashboard-pengadu', function () {
    return view('pengadu.dashboard');
})->middleware(RedirectIfNotPengadu::class)
  ->name('pengadu.dashboard');

Route::get('/login-admin', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login-admin', [AuthAdminController::class, 'login']);

Route::post('/logout-admin', [AuthPengaduController::class, 'logout'])->name('admin.logout');

Route::get('/dashboard-admin', function () {
    return view('admin.dashboard');
})->middleware(RedirectIfNotAdmin::class)
  ->name('admin.dashboard');

