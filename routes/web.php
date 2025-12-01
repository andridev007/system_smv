<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// User Menu Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/deposit', [UserMenuController::class, 'deposit'])->name('user.deposit');
    Route::get('/investment', [UserMenuController::class, 'investment'])->name('user.investment');
    Route::get('/withdraw', [UserMenuController::class, 'withdraw'])->name('user.withdraw');
    Route::get('/transactions', [UserMenuController::class, 'transactions'])->name('user.transactions');
    Route::get('/referral', [UserMenuController::class, 'referral'])->name('user.referral');
    Route::get('/settings', [UserMenuController::class, 'settings'])->name('user.settings');
});
