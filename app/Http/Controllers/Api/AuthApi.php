<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApi extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => ['required'],
            'password' => ['required'],
        ]);

        $credentials['password'] = md5($credentials['password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended()->with('message', '<strong>Hallo ' . Auth::user()->name . '!</strong> Welcome to administrator page.');
        }

        return redirect('/login')->withErrors([
            'nik' => 'NIK atau password yang dimasukkan salah!.',
        ])->onlyInput('nik');
    }
}
