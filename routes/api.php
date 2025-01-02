<?php

use App\Http\Controllers\OrderController;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('orders', OrderController::class);
Route::get('suggestion/cities', [\App\Http\Controllers\CityController::class,'suggestion']);

require __DIR__.'/auth.php';
