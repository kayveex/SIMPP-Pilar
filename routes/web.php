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
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        // Update Project - Start
        Route::patch('/{id}/detail-update', [ProjectController::class, 'updateDetail'])->name('projects.update.detail');

        // Update Project - End
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
        Route::get('/', [MaterialController::class, 'index'])->name('material.index');
        
        // Additional material pages that have corresponding controller methods
        Route::get('/create', [MaterialController::class, 'create'])->name('material.create');
        Route::post('/store', [MaterialController::class, 'storeMaterial'])->name('material.store');
        Route::delete('/delete/{id}', [MaterialController::class, 'deleteMaterial'])->name('material.delete');
        Route::get('/edit/{id}', [MaterialController::class, 'editPage'])->name('material.edit');
        Route::get('/view/{id}', [MaterialController::class, 'view'])->name('material.view');
        Route::get('/process/{id}', [MaterialController::class, 'process'])->name('material.process');
        Route::get('/approval/{id}', [MaterialController::class, 'approval'])->name('material.approval');
        Route::post('/approval/process/{id}', [MaterialController::class, 'processApproval'])->name('material.process-approval');
    });
    
    // Archive
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive');
    
    // Archive View (only if page exists)
    Route::get('/archive/{id}/view', [ArchiveViewController::class, 'index'])->name('archive.view');

    // Project Documents
    Route::prefix('projectDocs')->group(function() {
        Route::post('/upload/{id}', [ProjectController::class, 'addDocuments'])->name('projectDocs.upload');
        Route::delete('/{id}', [ProjectController::class, 'deleteDocument'])->name('projectDocs.delete');
    
    // Persetujuan Project
    Route::patch('/approval/{id}', [ProjectController::class, 'updatePersetujuanProject'])->name('project.approval');
    // Hapus Persetujuan Project
    Route::patch('/approval/delete/{id}', [ProjectController::class, 'deletePersetujuanProject'])->name('project.approval.delete');


    });
});

// Guest routes
Route::middleware('guest')->group(function() {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
});
