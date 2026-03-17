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
        error_log('[WanderWise DEBUG] Login attempt for email: ' . $request->email);

        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            error_log('[WanderWise DEBUG] Login SUCCESS for user: ' . $user->id . ' (Is Admin: ' . ($user->is_admin ? 'Yes' : 'No') . ')');
            
            if (!$user->is_admin) {
                error_log('[WanderWise DEBUG] Login BLOCKED: User is not admin.');
                Auth::logout();
                return back()->withErrors(['email' => 'Akses ditolak. Bukan admin.']);
            }
            
            // Temporary: Disable regeneration to avoid cookie issues on proxy
            // $request->session()->regenerate();
            
            error_log('[WanderWise DEBUG] Session ID after login: ' . session()->getId());
            error_log('[WanderWise DEBUG] Redirecting to dashboard...');
            return redirect()->route('admin.dashboard');
        }

        error_log('[WanderWise DEBUG] Login FAILED for email: ' . $request->email);
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
