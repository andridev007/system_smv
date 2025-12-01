<?php

use App\Http\Controllers\Api\MootaController;
use Illuminate\Support\Facades\Route;

Route::post('/callback/moota', [MootaController::class, 'handleCallback']);
