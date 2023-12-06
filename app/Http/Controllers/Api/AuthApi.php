<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DailyInspection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthApi extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('user_id', 'password');

        $credentials['password'] = md5($credentials['password']);



        if (!Auth::attempt($credentials)) {

            return response()->json([
                'message' => 'Login gagal. Pastikan user id dan password sesuai.'
            ], 401);
        }
        $user = User::where('user_id', $credentials['user_id'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $area = Area::with([
            'question' => function ($query) {
                return $query->orderBy('question.numbering');
            },
            'question.answer' => function ($query) {
                return $query->orderBy('point');
            },
        ])->get();

        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => [
                'user' => $user,
                'area' => $area,
                'maxScore' => maxScore()
            ]
        ]);
    }

    function changePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);


        #Match The Old Password
        if (!Hash::check(md5($request->old_password), auth()->user()->password)) {
            return response()->json([
                'message' => 'Current password is wrong.'
            ], 401);
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make(md5($request->new_password))
        ]);

        return response()->json([
            'message' => 'Password changed successfully!'
        ], 200);
    }



    public function logout()
    {
        Auth::user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
