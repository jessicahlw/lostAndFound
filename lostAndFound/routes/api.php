<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DashboardAdminController;

// Route user info (optional)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin dashboard data API
// Route::middleware(['auth:sanctum', 'admin'])->get('/admin/dashboard', [DashboardAdminController::class, 'index']);
