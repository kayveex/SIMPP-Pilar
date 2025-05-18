<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Routes - Authentication
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');

// Routes - Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
