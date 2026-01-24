<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest; // Import ini!
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
class TransactionController extends Controller
{

public function index(Request $request)
    {
        // Ambil transaksi milik user yg login saja
        // paginate(10) artinya ambil 10 data per halaman
        $transactions = $request->user()->transactions()
                                ->with('category') // Load relasi biar cepat (Eager Loading)
                                ->latest()         // Urutkan dari yg terbaru
                                ->paginate(10);    // Pagination otomatis

        // Bungkus pakai Resource
        return TransactionResource::collection($transactions);
    }
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