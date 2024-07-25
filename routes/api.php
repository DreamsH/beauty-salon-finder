<?php

use App\Http\Controllers\SalonController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('salons', [SalonController::class, 'index']);
});