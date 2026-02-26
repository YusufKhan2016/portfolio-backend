<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeaturedWorkController;
use App\Http\Controllers\MyExperienceController;
use App\Http\Controllers\MyWorkController;
use App\Http\Controllers\ProjectTagController;
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

    //Project Tag
    Route::post('/project-tag', [ProjectTagController::class, 'store']);
    Route::delete('/project-tag/{id}', [ProjectTagController::class, 'destroy']);

    //Featured Work
    Route::post('/featured-work', [FeaturedWorkController::class, 'store']);
    Route::delete('/featured-work/{id}', [FeaturedWorkController::class, 'destroy']);
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

//Project Tag
Route::get('/project-tag', [ProjectTagController::class, 'index']);
Route::get('/project-tag/{id}', [ProjectTagController::class, 'show']);

//Featured work
Route::get('/featured-work', [FeaturedWorkController::class, 'index']);
Route::get('/featured-work/{id}', [FeaturedWorkController::class, 'show']);

