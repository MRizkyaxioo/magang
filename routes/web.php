<?php

use App\Http\Controllers\AuthPengaduController;
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

