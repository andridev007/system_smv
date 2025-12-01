<?php

use App\Http\Controllers\Api\MootaWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/callback/moota', [MootaWebhookController::class, 'handle']);
