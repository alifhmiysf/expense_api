<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Kita pakai 'sometimes' agar user tidak wajib kirim semua field kalau cuma mau edit satu field
        'category_id' => 'sometimes|required|exists:categories,id',
        'amount' => 'sometimes|required|numeric|min:1',
        'description' => 'sometimes|required|string|max:255',
        'transaction_date' => 'sometimes|required|date',
        ];
    }
}
