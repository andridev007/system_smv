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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Menu Routes
    Route::get('/deposit', [UserMenuController::class, 'deposit'])->name('deposit');
    Route::get('/investment', [UserMenuController::class, 'investment'])->name('investment');
    Route::get('/withdraw', [UserMenuController::class, 'withdraw'])->name('withdraw');
    Route::get('/transactions', [UserMenuController::class, 'transactions'])->name('transactions');
    Route::get('/referral', [UserMenuController::class, 'referral'])->name('referral');
    Route::get('/settings', [UserMenuController::class, 'settings'])->name('settings');
});
