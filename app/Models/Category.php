<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Category extends Model
{
   // 3. Whitelist kolom yang boleh diisi manual
    protected $fillable = [
        'name',
        'type', // income / expense
    ];
    
    // Relasi (Opsional, tapi bagus ada)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
