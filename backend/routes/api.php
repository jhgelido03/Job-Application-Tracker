<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyJobsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource('jobs',MyJobsController::class)->except('show')->middleware('auth:sanctum');
Route::get('/jobs/{id}',[MyJobsController::class,'show'])->middleware('auth:sanctum');
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');