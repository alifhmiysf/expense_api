<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'description', 'ip_address', 'user_agent'];

    // Helper sakti: Tinggal panggil ActivityLog::record(...) dari mana saja
    public static function record($userId, $action, $description)
    {
        return self::create([
            'user_id'     => $userId,
            'action'      => $action,
            'description' => $description,
            'ip_address'  => request()->ip(),        // Otomatis catat IP
            'user_agent'  => request()->userAgent(), // Otomatis catat Browser/HP
        ]);
    }
}