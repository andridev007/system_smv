<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// User Menu Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/deposit', [UserMenuController::class, 'deposit'])->name('user.deposit');
    Route::post('/deposit', [UserMenuController::class, 'storeDeposit'])->name('user.deposit.store');
    Route::get('/deposit/{deposit}/confirmation', [UserMenuController::class, 'depositConfirmation'])->name('user.deposit.confirmation');
    Route::get('/investment', [UserMenuController::class, 'investment'])->name('user.investment');
    Route::get('/withdraw', [UserMenuController::class, 'withdraw'])->name('user.withdraw');
    Route::get('/transactions', [UserMenuController::class, 'transactions'])->name('user.transactions');
    Route::get('/referral', [UserMenuController::class, 'referral'])->name('user.referral');
    Route::get('/settings', [UserMenuController::class, 'settings'])->name('user.settings');
});

// Admin Routes (Protected)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/deposits', [AdminController::class, 'deposits'])->name('admin.deposits');
    Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('admin.withdrawals');
});
