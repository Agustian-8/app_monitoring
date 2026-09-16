<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required', // Kita ganti namanya jadi login_id
            'password' => 'required'
        ]);

        $loginId = $request->login_id;

        // Mencari user berdasarkan Email ATAU Nomor HP
        $user = \App\Models\User::where('email', $loginId)
                    ->orWhere('no_hp', $loginId)
                    ->first();

        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email/No. HP atau Password salah.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'access_token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }
}