<?php

use App\Http\Controllers\Api\MootaController;
use Illuminate\Support\Facades\Route;

Route::post('/moota/webhook', [MootaController::class, 'handleWebhook'])->name('api.moota.webhook');
