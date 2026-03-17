<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Login attempt for email: ' . $request->email);

        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            Log::info('Login success for user: ' . Auth::user()->id . ' (Is Admin: ' . (Auth::user()->is_admin ? 'Yes' : 'No') . ')');
            
            if (!Auth::user()->is_admin) {
                Log::warning('Login blocked: User is not admin.');
                Auth::logout();
                return back()->withErrors(['email' => 'Akses ditolak. Bukan admin.']);
            }
            
            $request->session()->regenerate();
            Log::info('Session regenerated. Redirecting to dashboard.');
            return redirect()->route('admin.dashboard');
        }

        Log::error('Login failed for email: ' . $request->email);
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
