<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/user');
            }
        }

        return back()->withErrors(['email' => 'Login gagal, cek kembali email & password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
