<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Laravel\Sanctum\HasApiTokens;
class Category extends Model
{
   // 3. Whitelist kolom yang boleh diisi manual
    protected $fillable = [
        'name',
        'type', // income / expense
        'user_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Relasi (Opsional, tapi bagus ada)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
