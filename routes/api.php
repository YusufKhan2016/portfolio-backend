<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyExperienceController;
use App\Http\Controllers\MyWorkController;
use App\Http\Controllers\TechStackController;

use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout', [AuthController::class, 'logout']);

    //My work
    Route::post('/my-work', [MyWorkController::class, 'store']);
    Route::delete('/my-work/{id}', [MyWorkController::class, 'destroy']);

    //Tech stacks
    Route::post('/tech-stack', [TechStackController::class, 'store']);
    Route::delete('/tech-stack/{id}', [TechStackController::class, 'destroy']);

    //My Experiences
    Route::post('/experience', [MyExperienceController::class, 'store']);
    Route::delete('/experience/{id}', [MyExperienceController::class, 'destroy']);
});

//My work
Route::get('/my-work', [MyWorkController::class, 'index']);
Route::get('/my-work/{id}', [MyWorkController::class, 'show']);

//Tech stacks
Route::get('/tech-stack', [TechStackController::class, 'index']);
Route::get('/tech-stack/{id}', [TechStackController::class, 'show']);

//My experiences
Route::get('/experience', [MyExperienceController::class, 'index']);
Route::get('/experience/{id}', [MyExperienceController::class, 'show']);


