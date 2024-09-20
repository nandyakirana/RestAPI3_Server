<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('proses_login');

// //Route::resource('/todos', TodoController::class);
Route::middleware(['Auth'])->group(function () {
     Route::resource('todos', TodoController::class);

     Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});