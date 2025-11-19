<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rota Pública
Route::post('/', [LoginController::class, 'login'])->name('login');

//Rota Restritas
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Rotas protegidas aqui
    Route::ApiResource('/users', UsersController::class);
    Route::post('/logout/{user}', [LoginController::class, 'logout'])->name('logout');
});
