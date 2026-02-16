<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;

// Redirect homepage ke login
Route::get('/', function () {
    return redirect('/login');
});

// Public routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::post('/login/siswa', [AuthController::class, 'loginSiswa'])->name('login.siswa');

// Admin routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/aspirasi', [AdminController::class, 'listAspirasi'])->name('aspirasi.list');
    Route::get('/aspirasi/{id}', [AdminController::class, 'detailAspirasi'])->name('aspirasi.detail');
    Route::post('/aspirasi/{id}/status', [AdminController::class, 'updateStatus'])->name('aspirasi.updateStatus');
    Route::get('/feedback', [AdminController::class, 'viewFeedback'])->name('feedback');
    Route::get('/histori', [AdminController::class, 'histori'])->name('histori');
    Route::post('/logout', [AuthController::class, 'logoutAdmin'])->name('logout');
    Route::post('/aspirasi/{id}/feedback', [AdminController::class, 'submitFeedback'])->name('aspirasi.submitFeedback');
});

// Siswa routes
Route::middleware(['auth:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/aspirasi/form', [SiswaController::class, 'formAspirasi'])->name('aspirasi.form');
    Route::post('/aspirasi/store', [SiswaController::class, 'storeAspirasi'])->name('aspirasi.store');
    Route::get('/aspirasi/status', [SiswaController::class, 'statusPenyelesaian'])->name('aspirasi.status');
    Route::get('/aspirasi/histori', [SiswaController::class, 'historiUser'])->name('aspirasi.histori');
    Route::get('/aspirasi/progress', [SiswaController::class, 'progressPerbaikan'])->name('aspirasi.progress');
    Route::post('/logout', [AuthController::class, 'logoutSiswa'])->name('logout');
    Route::get('/aspirasi/feedback', [SiswaController::class, 'viewFeedback'])->name('aspirasi.feedback');
});