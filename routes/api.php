<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\myWorkController;
use App\Http\Controllers\TechStackController;

use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout', [AuthController::class, 'logout']);

    //My work
    Route::post('/my-work', [myWorkController::class, 'store']);
    Route::delete('/my-work/{id}', [myWorkController::class, 'destroy']);

    //Tech stacks
    Route::post('/tech-stack', [TechStackController::class, 'store']);
    Route::delete('/tech-stack/{id}', [TechStackController::class, 'destroy']);
});

//My work
Route::get('/my-work', [myWorkController::class, 'index']);
Route::get('/my-work/{id}', [myWorkController::class, 'show']);

//Tech stacks
Route::get('/tech-stack', [TechStackController::class, 'index']);
Route::get('/tech-stack/{id}', [TechStackController::class, 'show']);


