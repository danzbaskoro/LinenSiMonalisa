<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return View('login.form-login', ['returnUrl' => $request->return_url]);
    }
    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);
        // dd(Hash::make($request->password));
        if (Auth::attempt($request->only('username', 'password'), $request->remember)) {
            $request->session()->regenerate();
            $redirectUrl = session()->get('url.intended', route('dashboard'));

            return response()->json(['message' => 'Login berhasil', 'redirect' => $redirectUrl], 200);
        }

        return response()->json(['message' => 'Username atau password salah'], 401);
    }

    public function logoutProcess()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();

        Log::info('User logged out', ['user' => Auth::user()]);
        return response()->json(['message' => 'Logout berhasil', 'redirect' => "/"], 200);
    }
}
