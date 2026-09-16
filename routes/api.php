<?php


use Illuminate\Support\Facades\Route;

Route::middleware('throttle:10,1')->get('/health', function() {
    return response()->json([
        'status' => 'online'
    ]);
});

