<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WasteBinController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login-jwt', [AuthController::class, 'loginJWT']);

Route::apiResource('waste-bins', WasteBinController::class);