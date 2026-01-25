<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    // 1. FITUR REGISTER
    public function register(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // confirmed butuh field password_confirmation
        ]);

        // Buat User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // PENTING: Hash password
        ]);

        // Buat Token (Tiket masuk)
        $token = $user->createToken('auth_token')->plainTextToken;
            ActivityLog::record($user->id, 'REGISTER', 'User registered new account');
        // Kirim Response JSON
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // 2. FITUR LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek User ada ATAU Password salah
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        // Kalau sukses, beri token baru
        $token = $user->createToken('auth_token')->plainTextToken;
        ActivityLog::record($user->id, 'LOGIN', 'User logged in via API');
        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'user' => $user
        ]);
    }
    
    // 3. FITUR LOGOUT
    public function logout(Request $request)
    {
        // Hapus token yang sedang dipakai (Revoke)
        $request->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'Token revoked']);
    }
}