<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Obras\ObrasController;
use Illuminate\Support\Facades\Route;

// Login
Route::post('/', [LoginController::class, 'login'])->name('login');

// Rotas protegidas
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/users', UsersController::class);
    Route::post('/logout/{user}', [LoginController::class, 'logout']);
});

// Obras (regras estão no controller)
Route::apiResource('/obras', ObrasController::class);
