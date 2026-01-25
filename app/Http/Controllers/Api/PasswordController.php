<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);

        $user = $request->user();
        if(!Hash::check($request->current_password, $user->password)){
            return response()->json([
                'message' => 'The provided password does not match your current password ',
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        ActivityLog::record($user->id, 'CHANGE_PASSWORD', 'User changed their password successfully');
        return response()->json([
            'message' => 'Password changed successfully',
        ]);
    }
}
