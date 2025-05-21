<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;



// Routes - Authenticated
Route::middleware('auth')->group(function() {
    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    // Routes - Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Routes - Proyek

});

Route::middleware('guest')->group(function() {
    // Routes - Authentication
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');

});



