<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_id' => ['required'],
            'password' => ['required'],
        ]);

        $credentials['password'] = md5($credentials['password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended()->with('message', '<strong>Hallo ' . Auth::user()->name . ',</strong> Welcome to Optimals.');
        }

        return redirect('/login')->withErrors([
            'user_id' => 'User ID atau password yang dimasukkan salah!.',
        ])->onlyInput('user_id');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
