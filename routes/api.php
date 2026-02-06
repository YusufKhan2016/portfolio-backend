<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\myWorkController;

use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('/my-work', [myWorkController::class, 'store']);
});

Route::get('/my-work', [myWorkController::class, 'index']);
Route::get('/my-work/{id}', [myWorkController::class, 'show']);


