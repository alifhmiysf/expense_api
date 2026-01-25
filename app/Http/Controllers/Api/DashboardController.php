<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Input (Default ke Bulan & Tahun sekarang)
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y')); // Pakai Y besar biar jadi 2026 (bukan 26)
        
        $user = $request->user();

        // 2. AMBIL DATA DULU (Ini yang hilang di kodinganmu tadi)
        // Kita ambil semua transaksi bulan ini + data kategorinya
        $transactions = $user->transactions()
                             ->with('category') // Load relasi biar tahu tipe income/expense
                             ->whereMonth('transaction_date', $month)
                             ->whereYear('transaction_date', $year)
                             ->get();

        // 3. HITUNG PAKAI COLLECTION (Lebih simpel & aman)
        // Filter yang tipe income, lalu jumlahkan
        $totalIncome = $transactions->where('category.type', 'income')->sum('amount');
        
        // Filter yang tipe expense, lalu jumlahkan
        $totalExpense = $transactions->where('category.type', 'expense')->sum('amount');

        // 4. Hitung Sisa Saldo
        $balance = $totalIncome - $totalExpense;

        // 5. Return JSON
        return response()->json([
            'month' => $month,
            'year' => $year,
            'total_income' => (float) $totalIncome,
            'total_expense' => (float) $totalExpense,
            'balance' => (float) $balance,
            'format_balance' => 'Rp ' . number_format($balance, 0, ',', '.')
        ]);
    }
}