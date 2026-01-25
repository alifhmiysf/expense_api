<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// 👇 TAMBAHKAN BARIS INI!
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request){
        $user = $request->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'avatar' =>'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->hasFile('avatar')){
            if($user->avatar && Storage::disk('public')->exists($user->avatar)){
                Storage::disk('public')->delete($user->avatar); 
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
        $user->save();
        ActivityLog::record($user->id, 'UPDATE_PROFILE', 'User updated profile details or avatar');
        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user,
            'avatar_url' => $user->avatar ? asset('storage/'. $user->avatar) :null,
        ]);

    }

}
