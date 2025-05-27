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
// New controllers for detailed pages
use App\Http\Controllers\AnggaranRealisasiController;
use App\Http\Controllers\AnggaranRencanaController;
use App\Http\Controllers\ArchiveViewController;

// Routes - Authenticated
Route::middleware('auth')->group(function() {
    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Project Routes
    Route::prefix('projects')->group(function() {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::get('/add', [ProjectController::class, 'add'])->name('projects.add');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/{id}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
    
    // Schedule
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    
    // Anggaran
    Route::get('/anggaran', [AnggaranController::class, 'index'])->name('anggaran');
    
    // Anggaran Realisasi (only if page exists)
    Route::get('/anggaran/realisasi/{id}', [AnggaranRealisasiController::class, 'index'])->name('anggaran.realisasi');
    
    // Anggaran Rencana (only if page exists)
    Route::get('/anggaran/rencana/{id}', [AnggaranRencanaController::class, 'index'])->name('anggaran.rencana');
    
    // Material Routes
    Route::prefix('material')->group(function() {
        // Main material page
        Route::get('/', [MaterialController::class, 'index'])->name('material');
        
        // Additional material pages that have corresponding controller methods
        Route::get('/add', [MaterialController::class, 'add'])->name('material.add');
        Route::get('/view/{id?}', [MaterialController::class, 'view'])->name('material.view');
        Route::get('/status', [MaterialController::class, 'status'])->name('material.status');
        Route::get('/process/{id}', [MaterialController::class, 'process'])->name('material.process');
        Route::get('/approval/{id}', [MaterialController::class, 'approval'])->name('material.approval');
        Route::post('/approval/process/{id}', [MaterialController::class, 'processApproval'])->name('material.process-approval');
    });
    
    // Archive
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive');
    
    // Archive View (only if page exists)
    Route::get('/archive/{id}/view', [ArchiveViewController::class, 'index'])->name('archive.view');
});

// Guest routes
Route::middleware('guest')->group(function() {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
});



