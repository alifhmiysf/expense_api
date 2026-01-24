<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'amount' => $this->amount, // Angka asli (untuk kalkulasi di frontend)
        'amount_formatted' => 'Rp ' . number_format($this->amount, 0, ',', '.'), // Tampilan cantik
        'description' => $this->description,
        'category_name' => $this->category->name, // MAGIC: Ambil nama kategori langsung!
        'status' => $this->category->type, // Expense/Income
        'transaction_date' => $this->transaction_date,
        'created_at_human' => $this->created_at->diffForHumans(), // "1 hour ago"
        'created_at_exact' => $this->created_at->format('d F Y H:i'), // "24 January 2026 13:00"
    ];
}
}
