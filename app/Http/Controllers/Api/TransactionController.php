<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest; // ✅ 1. INI DITAMBAHKAN
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    // 1. INDEX (Lihat semua data)
    public function index(Request $request)
    {
        $transactions = $request->user()->transactions()
                                ->with('category')
                                ->latest()
                                ->paginate(10);

        return TransactionResource::collection($transactions);
    }

    // 2. STORE (Simpan data baru)
    public function store(StoreTransactionRequest $request)
    {
        $user = $request->user();
        $transaction = $user->transactions()->create($request->validated());

        // Kita ubah returnnya pakai Resource supaya formatnya konsisten cantik
        return new TransactionResource($transaction);
    } // ✅ 2. KURUNG KURAWAL INI TADI HILANG

    // 3. SHOW (Lihat 1 data spesifik)
    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== request()->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return new TransactionResource($transaction);
    }

    // 4. UPDATE (Edit data)
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        if ($transaction->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $transaction->update($request->validated());

        return new TransactionResource($transaction);
    }

    // 5. DESTROY (Hapus data)
    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== request()->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaction deleted successfully'
        ], 200);
    }
}