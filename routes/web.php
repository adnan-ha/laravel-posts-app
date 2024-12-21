<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
  Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
  Route::post('/', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
  Route::resource('posts', PostController::class);
  Route::resource('users', UserController::class);
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
