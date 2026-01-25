<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- IMPORT CONTROLLERS ---
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ========================================================================
// 🔓 PUBLIC ROUTES (Bisa diakses tanpa Token)
// ========================================================================

// 1. Register User Baru
Route::post('/register', [AuthController::class, 'register']);

// 2. Login (DIPROTEKSI: Maksimal 5x percobaan per menit)
// Ini adalah implementasi Rate Limiting Hari 17
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');


// ========================================================================
// 🔒 PROTECTED ROUTES (Wajib bawa Bearer Token)
// ========================================================================

Route::middleware('auth:sanctum')->group(function () {

    // --- 👤 User & Profile Management ---
    // Cek data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Update Profile (Nama, Email) & Secure Upload Avatar
    Route::post('/profile', [ProfileController::class, 'update']);
    
    // Logout (Hapus Token)
    Route::post('/logout', [AuthController::class, 'logout']);


    // --- 📊 Dashboard ---
    // Rekap total saldo, pemasukan, dan pengeluaran
    Route::get('/dashboard', [DashboardController::class, 'index']);


    // --- 📂 Master Data: Categories ---
    // apiResource otomatis membuat 5 route sekaligus: index, store, show, update, destroy
    Route::apiResource('categories', CategoryController::class);


    // --- 💸 Main Feature: Transactions ---
    // apiResource menghandle CRUD lengkap Transaksi
    Route::apiResource('transactions', TransactionController::class);

});