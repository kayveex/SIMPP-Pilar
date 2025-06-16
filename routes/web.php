<?php

use App\Http\Controllers\AnggaranProyekController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScheduleController;
// Import controllers
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveViewController;
use App\Http\Controllers\MaterialItemExportController;
use App\Http\Controllers\MaterialItemsController;
use App\Http\Controllers\ProgressProyekController;

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
    Route::prefix('schedules')->group(function() {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::post('/store/{id}', [ScheduleController::class, 'storePhase'])->name('schedules.store');
        Route::get('/{id}/view', [ScheduleController::class, 'viewSchedule'])->name('schedules.view');
        // Edit project phase
        Route::get('/phase/{id}/edit', [ScheduleController::class, 'editJadwal'])->name('schedules.phase.edit');

        // PATCH Project Phase
        Route::patch('/phase/{id}', [ScheduleController::class, 'updatePhase'])->name('schedules.phase.update');

        // Update project phase completion status
        Route::patch('/phase/{id}/complete', [ScheduleController::class, 'updateIsCompleted'])->name('schedules.phase.complete');
        // undo completion
        Route::patch('/phase/{id}/undo', [ScheduleController::class, 'undoIsCompleted'])->name('schedules.phase.undo');
        // delete project phase
        Route::delete('/phase/{id}', [ScheduleController::class, 'destroyPhase'])->name('schedules.phase.destroy');
    });

    // Progress Proyek
    Route::prefix('progress-proyek')->group(function() {
        Route::get('/', [ProgressProyekController::class, 'index'])->name('progress-proyek.index');
        Route::get('/view/{id}', [ProgressProyekController::class, 'viewProgress'])->name('progress-proyek.view');
        Route::get('/report/{id}', [ProgressProyekController::class, 'viewReport'])->name('progress-proyek.report');
        Route::get('/report/detail/{reportId}', [ProgressProyekController::class, 'viewDetailReport'])->name('progress-proyek.report.detail');
        Route::post('/report/store/{id}', [ProgressProyekController::class, 'storeReport'])->name('progress-proyek.report.store');
        Route::delete('/report/delete/{reportId}', [ProgressProyekController::class, 'deleteReport'])->name('progress-proyek.report.delete');
        Route::patch('/report/update/{reportId}', [ProgressProyekController::class, 'editReport'])->name('progress-proyek.report.update');
        Route::post('/report/upload/{reportId}', [ProgressProyekController::class, 'addReportFiles'])->name('progress-proyek.report.upload');
        Route::delete('/report/files/delete/{fileId}', [ProgressProyekController::class, 'deleteReportFile'])->name('progress-proyek.report.files.delete');
    });
    
    // Material Routes
    Route::prefix('material')->group(function() {
        // Main material page
        Route::get('/', [MaterialController::class, 'index'])->name('material.index');
        // Show material details
        Route::get('/view/{id}', [MaterialController::class, 'viewPage'])->name('material.view');
        
        // Additional material pages that have corresponding controller methods
        Route::get('/create', [MaterialController::class, 'create'])->name('material.create');
        Route::post('/store', [MaterialController::class, 'storeMaterial'])->name('material.store');
        Route::delete('/delete/{id}', [MaterialController::class, 'deleteMaterial'])->name('material.delete');
        Route::get('/edit/{id}', [MaterialController::class, 'editPage'])->name('material.edit');
        Route::patch('update/{id}', [MaterialController::class, 'updateMaterial'])->name('material.update');

        // Approval Material for Purchasing
        Route::patch('/approval/{id}', [MaterialController::class, 'updateApproval'])->name('material.approval');
        // Delete Approval Material for Purchasing
        Route::patch('/approval/delete/{id}', [MaterialController::class, 'deleteApproval'])->name('material.approval.delete');

    });

    // Material Items
    Route::prefix('material-items')->group(function() {
        // Show material item details
        Route::get('/view/{id}', [MaterialItemsController::class, 'showMaterialItem'])->name('material-items.view');
        Route::get('/create/{id}', [MaterialItemsController::class, 'createMaterialItem'])->name('material-items.create');
        Route::post('/store/{id}', [MaterialItemsController::class, 'storeMaterialItem'])->name('material-items.store');
        Route::get('/edit/{id}', [MaterialItemsController::class, 'editMaterialItem'])->name('material-items.edit');
        Route::patch('/update/{id}', [MaterialItemsController::class, 'updateMaterialItem'])->name('material-items.update');
        Route::delete('/delete/{id}', [MaterialItemsController::class, 'deleteMaterialItem'])->name('material-items.delete');
    });
    
    // Anggaran Proyek
    Route::prefix('anggaran-proyek')->group(function() {
        Route::get('/', [AnggaranProyekController::class, 'index'])->name('anggaran-proyek.index');
        Route::get('/detail/{projectId}', [AnggaranProyekController::class, 'detailAnggaran'])->name('anggaran-proyek.detail');
        

    });

    // Archive
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive');
    
    // Archive View (only if page exists)
    Route::get('/archive/{id}/view', [ArchiveViewController::class, 'index'])->name('archive.view');

    // Project Documents
    Route::prefix('projectDocs')->group(function() {
        Route::post('/upload/{id}', [ProjectController::class, 'addDocuments'])->name('projectDocs.upload');
        Route::delete('/{id}', [ProjectController::class, 'deleteDocument'])->name('projectDocs.delete');
    });

    // Export Material Items
    Route::prefix('export')->group(function() {
        Route::get('material-items/{material}', [MaterialItemExportController::class, 'export'])->name('material-items.export');
    });
});

// Guest routes
Route::middleware('guest')->group(function() {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
});
