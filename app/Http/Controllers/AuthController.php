<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended()->with('message', '<strong>Hallo ' . Auth::user()->name . '!</strong> Welcome to administrator page.');
        }

        return redirect('/login')->withErrors([
            'nik' => 'NIK atau password yang dimasukkan salah!.',
        ])->onlyInput('nik');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
