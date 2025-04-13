<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->username === "aldmic" && $request->password === "123abc123")
        {
            session(['logged_in' => true]);
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Username or Password incorrect!');
    }

    public function logout()
    {
        session()->forget('logged_in');
        return redirect()->route('login');
    }
}
