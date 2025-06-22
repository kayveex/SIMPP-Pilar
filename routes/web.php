<?php

use App\Http\Controllers\AnggaranProyekController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScheduleController;
// Import controllers
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ArsipProyekController;
use App\Http\Controllers\MaterialItemExportController;
use App\Http\Controllers\MaterialItemsController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\ProgressProyekController;
use App\Http\Controllers\UserProfileController;

// Routes - Authenticated
Route::middleware('auth')->group(function() {
    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    // Dashboard
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    // User Profile
    Route::prefix('user')->group(function() {
        Route::get('/profile/edit/{userId}', [UserProfileController::class, 'editProfile'])->name('user.profile.edit');
        Route::patch('/profile/update/{userId}', [UserProfileController::class, 'updateProfile'])->name('user.profile.update');
        Route::patch('/profile/update-password/{userId}', [UserProfileController::class, 'updatePassword'])->name('user.profile.update.password');

    });
        
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
        Route::get('/{id}/calendar-events', [ScheduleController::class, 'getCalendarEvents'])->name('schedules.calendar.events');
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
        // Main material page - accessible by Technical and Purchasing
        Route::get('/', [MaterialController::class, 'index'])->name('material.index');
        // Show material details - accessible by Technical and Purchasing
        Route::get('/view/{id}', [MaterialController::class, 'viewPage'])->name('material.view');
        
        // Material creation and editing - Technical can create/edit (with limited fields)
        Route::get('/create', [MaterialController::class, 'create'])->name('material.create');
        Route::post('/store', [MaterialController::class, 'storeMaterial'])->name('material.store');
        Route::get('/edit/{id}', [MaterialController::class, 'editPage'])->name('material.edit');
        Route::patch('update/{id}', [MaterialController::class, 'updateMaterial'])->name('material.update');

        // Material approval and deletion - Purchasing only (handled in controller)
        Route::patch('/approval/{id}', [MaterialController::class, 'updateApproval'])->name('material.approval');
        Route::patch('/approval/delete/{id}', [MaterialController::class, 'deleteApproval'])->name('material.approval.delete');
        Route::delete('/delete/{id}', [MaterialController::class, 'deleteMaterial'])->name('material.delete');
    });

    // Material Items - accessible by Technical and Purchasing
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
        Route::get('/add/{projectId}', [AnggaranProyekController::class, 'addAnggaranRencana'])->name('anggaran-proyek.add');
        Route::get('/add-realisasi/{projectId}', [AnggaranProyekController::class, 'addAnggaranRealisasi'])->name('anggaran-proyek.add.realisasi');
        //Store API
        Route::post('/store-anggaran-rencana/{projectId}', [AnggaranProyekController::class, 'storeAnggaranRencana'])->name('anggaran-proyek.rencana.store');
        Route::post('/store-anggaran-rencana-items', [AnggaranProyekController::class, 'storeAnggaranRencanaItems'])->name('anggaran-proyek.rencana.items.store');
        Route::post('/store-anggaran-realisasi/{projectId}', [AnggaranProyekController::class, 'storeAnggaranRealisasi'])->name('anggaran-proyek.realisasi.store');
        Route::post('/store-anggaran-realisasi-items', [AnggaranProyekController::class, 'storeAnggaranRealisasiItems'])->name('anggaran-proyek.realisasi.items.store');

        // Delete Anggaran Rencana
        Route::delete('/delete-anggaran-rencana/{id}', [AnggaranProyekController::class, 'deleteAnggaranRencana'])->name('anggaran-proyek.rencana.delete');
        // Delete Anggaran Rencana Items
        Route::delete('/delete-anggaran-rencana-items/{id}', [AnggaranProyekController::class, 'deleteAnggaranRencanaItem'])->name('anggaran-proyek.rencana.items.delete');
        // Delete Anggaran Realisasi
        Route::delete('/delete-anggaran-realisasi/{id}', [AnggaranProyekController::class, 'deleteAnggaranRealisasi'])->name('anggaran-proyek.realisasi.delete');
        // Delete Anggaran Realisasi Items
        Route::delete('/delete-anggaran-realisasi-items/{id}', [AnggaranProyekController::class, 'deleteAnggaranRealisasiItem'])->name('anggaran-proyek.realisasi.items.delete');

        // Export Budget
        Route::get('/export/{projectId}', [AnggaranProyekController::class, 'exportBudget'])->name('anggaran-proyek.export');
        Route::get('/export-rencana/{projectId}', [AnggaranProyekController::class, 'exportAnggaranRencana'])->name('anggaran-proyek.export.rencana');
        Route::get('/export-realisasi/{projectId}', [AnggaranProyekController::class, 'exportAnggaranRealisasi'])->name('anggaran-proyek.export.realisasi');

        
    });

    // Notifikasi
    Route::prefix('notif')->group(function() {
        Route::get('/', [NotifController::class, 'index'])->name('notif.index');
        Route::patch('/mark-as-read/{id}', [NotifController::class, 'markAsRead'])->name('notif.mark-as-read');
        Route::patch('/mark-all-as-read', [NotifController::class, 'markAllAsRead'])->name('notif.mark-all-as-read');
    });

    // Arsip Proyek
    Route::prefix('arsip-proyek')->group(function() {
        Route::get('/', [ArsipProyekController::class, 'index'])->name('arsip-proyek.index');
        Route::get('/{id}', [ArsipProyekController::class, 'showArsip'])->name('arsip-proyek.show');
    });

    // Project Documents
    Route::prefix('projectDocs')->group(function() {
        Route::post('/upload/{id}', [ProjectController::class, 'addDocuments'])->name('projectDocs.upload');
        Route::delete('/{id}', [ProjectController::class, 'deleteDocument'])->name('projectDocs.delete');
    });

    // Export Material Items - accessible by Technical and Purchasing
    Route::prefix('export')->group(function() {
        Route::get('material-items/{material}', [MaterialItemExportController::class, 'export'])->name('material-items.export');
    });
});

// Guest routes
Route::middleware('guest')->group(function() {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
});
