<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest; // Import ini!
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Method untuk menyimpan data (CREATE)
    public function store(StoreTransactionRequest $request)
    {
        // 1. Ambil user yang sedang login
        $user = $request->user();

        // 2. Simpan ke database via relasi
        // Laravel otomatis mengisi kolom 'user_id'
        $transaction = $user->transactions()->create($request->validated());

        // 3. Return response JSON
        return response()->json([
            'message' => 'Transaction saved successfully',
            'data' => $transaction
        ], 201);
    }
}