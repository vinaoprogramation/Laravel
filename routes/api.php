<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\StoreProductController;

Route::middleware('throttle:10,1')->get('/health', HealthCheckController::class);

Route::get('/admin/settings', SettingsController::class);

Route::post('/products', StoreProductController::class);