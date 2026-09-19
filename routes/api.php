<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\StoreProductController;

Route::middleware('throttle:10,1')->get('/health', HealthCheckController::class);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/settings', SettingsController::class);

Route::middleware('auth:sanctum')->group(function () {

  Route::get('/user', function (Request $request){
    return $request->user();
  });
  
  Route::post('/products', StoreProductController::class);

});

