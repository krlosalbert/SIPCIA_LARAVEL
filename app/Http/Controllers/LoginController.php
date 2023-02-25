<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user' => 'required|unique:tbluser,UserIdCard',
            'password' => 'required|unique:tbluser,UserPassword',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            /* return redirect()->intended('home'); */
            return view('home');
        }

        return back()->withErrors([
            'user' => 'The provided credentials do not match our records.',
        ]);
    }
}
