<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!Auth::attempt($credentials)) {
            return view('login')->withErrors(['error' => 'The provided credentials do not match our records']);
        }
        return redirect()->route('home')->with('message', 'You are now logged in');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
