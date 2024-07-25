<?php

use App\Http\Middleware\CronAuth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([CronAuth::class])->group(function () {
    Route::get('/cron/import-salons', function () {
        Artisan::call('import:salons');
        return response()->json(['status' => 'Import command executed'], 200);
    });
});