<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScheduleController;
// Import controllers
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\ArchiveController;

// Routes - Authenticated
Route::middleware('auth')->group(function() {
    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    // Routes - Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route for dashboard page
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Project Routes with better naming convention
    Route::prefix('projects')->group(function() {
        // List all projects
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        
        // Create new project form
        Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
        
        // Add project form
        Route::get('/add', [ProjectController::class, 'add'])->name('projects.add');
        
        // Store new project
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        
        // Show project details (must be after /create to prevent conflicts)
        Route::get('/{id}', [ProjectController::class, 'show'])->name('projects.show');
        
        // Edit project form
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        
        // Update project
        Route::put('/{id}', [ProjectController::class, 'update'])->name('projects.update');
        
        // Delete project
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
    
    // Schedule Routes
    Route::prefix('schedule')->group(function() {
        // View schedule dashboard
        Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
        
        // Edit schedule page - rename this line if you want
        Route::get('/schedule', [ScheduleController::class, 'schedule'])->name('schedule.edit');
        
        // Update schedule
        Route::post('/update', [ScheduleController::class, 'update'])->name('schedule.update');
    });

    // Simple Material Route
    Route::get('/material', [MaterialController::class, 'index'])->name('material');
    
    // Simple Anggaran Route
    Route::get('/anggaran', [AnggaranController::class, 'index'])->name('anggaran');
    
    // Simple Archive Route
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive');
});

Route::middleware('guest')->group(function() {
    // Routes - Authentication
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
});



