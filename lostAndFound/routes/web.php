<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ClaimController;

// 🟢 Public routes (akses tanpa login)
Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// 🔐 Protected routes (login wajib)
Route::middleware('auth')->group(function () {

    // 🔄 Redirect role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard.user');
    })->name('dashboard');

    // 👤 Dashboard user
    Route::get('/dashboard/user', [DashboardController::class, 'index'])->name('dashboard.user');

    // 👮‍♂️ Dashboard admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
        Route::delete('/admin/laporan/{id}', [DashboardAdminController::class, 'destroy'])->name('admin.laporan.delete');
        Route::get('/admin/laporan/{id}/claims', [BarangController::class, 'getClaims'])->name('admin.laporan.claims');
    });

    // 📦 CRUD Barang (tanpa index karena udah dipakai untuk feed)
    Route::resource('barang', BarangController::class)->except(['index']);

    // 🗂 Feed semua barang temuan
    Route::get('/feed', [BarangController::class, 'index'])->name('feed.index');

    // 📋 Klaim Barang
    Route::get('/claim/{id}', [ClaimController::class, 'showClaimPage'])->name('barang.claim.show');
    Route::get('/barang/{id}/klaim', [ClaimController::class, 'formKlaim'])->name('barang.formKlaim');
    Route::post('/barang/{id}/klaim', [ClaimController::class, 'claim'])->name('barang.claim');
    Route::post('/barang/{id}/proses-klaim', [ClaimController::class, 'prosesKlaim'])->name('barang.klaim.submit');
    Route::post('/klaim/{id}/terima', [ClaimController::class, 'terima'])->name('klaim.terima');
    Route::post('/klaim/{id}/tolak', [ClaimController::class, 'tolak'])->name('klaim.tolak');

    // 📤 Upload Barang Temuan
    Route::get('/upload', [LaporanController::class, 'form'])->name('upload.form');
    Route::post('/upload/proses', [LaporanController::class, 'proses'])->name('upload.proses');

    // 🔍 Detail Laporan
    Route::get('/laporan/{id}', [LaporanController::class, 'detail'])->name('laporan.detail');

    // 🚪 Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
