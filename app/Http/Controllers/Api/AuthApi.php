<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApi extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        $credentials['password'] = md5($credentials['password']);



        if (!Auth::attempt($credentials)) {

            return response()->json([
                'message' => 'Login gagal. Pastikan nik dan password sesuai.'
            ], 401);
        }
        $user = User::where('nik', $credentials['nik'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $area = Area::with(['question', 'question.answer'])->get();

        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => [
                'user' => $user,
                'area' => $area
            ]
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
