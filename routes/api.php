<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// PENTING: Baris ini memanggil Controller yang tadi kamu buat
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Tidak butuh token) ---
// Kalau orang akses POST /api/register -> lari ke AuthController fungsi register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// --- PROTECTED ROUTES (Harus bawa Token) ---
// Middleware 'auth:sanctum' akan menolak request tanpa token valid
Route::middleware('auth:sanctum')->group(function () {
    
    // Cek Profile Sendiri: GET /api/user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout: POST /api/logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
});