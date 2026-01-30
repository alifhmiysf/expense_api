<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\ActivityLog; // ✅ Pastikan ini di-import
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->transactions()->with('category');

        $query->when($request->month, fn($q) => $q->whereMonth('transaction_date', $request->month));
        $query->when($request->year, fn($q) => $q->whereYear('transaction_date', $request->year));
        $query->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id));

        return TransactionResource::collection($query->latest()->paginate(10));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = $request->user()->transactions()->create($request->validated());

        // ✅ CATAT LOG
        ActivityLog::record(auth()->id(), 'CREATE_TRANSACTION', "Catat: {$transaction->description}");

        return new TransactionResource($transaction);
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        $transaction->update($request->validated());

        ActivityLog::record(auth()->id(), 'UPDATE_TRANSACTION', "Edit: {$transaction->id}");

        return new TransactionResource($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);
        $desc = $transaction->description;
        $transaction->delete();

        ActivityLog::record(auth()->id(), 'DELETE_TRANSACTION', "Hapus: {$desc}");

        return response()->json(['message' => 'Transaction deleted successfully']);
    }

    // ✅ FITUR TAMBAHAN: RESTORE
    public function restore($id)
    {
        $transaction = Transaction::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $transaction->restore();
        ActivityLog::record(auth()->id(), 'RESTORE_TRANSACTION', "Kembalikan ID: {$id}");

        return new TransactionResource($transaction);
    }
}