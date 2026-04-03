<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.profile.edit');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'pin' => ['required', 'string', 'size:4'],
        ]);

        $user = \App\Models\User::first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->pin, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('admin.profile.edit'));
        }

        return back()->withErrors([
            'pin' => 'PIN salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
