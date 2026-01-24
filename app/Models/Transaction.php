<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;

class Transaction extends Model
{
    use HasFactory, softDeletes;

    protected $fillable =[
        'user_id',
        'category_id',
        'amount',
        'description',
        'transaction_date'
    ];

    //transaksi ini punya siapa 
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Transaksi ini kategorinya apa?
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
