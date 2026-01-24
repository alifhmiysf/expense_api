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
    public function index(Request $request)
    {
        // 1. Mulai Query dari user yg login & load relasi category
        $query = $request->user()->transactions()->with('category');

        // 2. FILTER: Bulan (Jika ada request month)
        $query->when($request->month, function ($q) use ($request) {
            $q->whereMonth('transaction_date', $request->month);
        });

        // 3. FILTER: Tahun (Jika ada request year)
        $query->when($request->year, function ($q) use ($request) {
            $q->whereYear('transaction_date', $request->year);
        });

        // 4. FILTER: Kategori (Jika ada request category_id)
        $query->when($request->category_id, function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });

        // 5. Eksekusi: Ambil data terbaru & paginate
        $transactions = $query->latest()->paginate(10);

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