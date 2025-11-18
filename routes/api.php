<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CreateuserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rota Pública
Route::post('/', [LoginController::class, 'login'])->name('login');

//Rota Restritas
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Rotas protegidas aqui
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/logout/{user}', [LoginController::class, 'logout'])->name('logout');
    Route::post('/createuser', [CreateuserController::class, 'createUser'])->name('createuser');
});
