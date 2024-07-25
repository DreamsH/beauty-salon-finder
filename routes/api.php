<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\SalonController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('health', [ApiController::class, 'index']);
});

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('salons', [SalonController::class, 'index']);
});