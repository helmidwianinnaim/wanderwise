<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        error_log('[WanderWise DEBUG] AdminMiddleware hit for path: ' . $request->path());
        error_log('[WanderWise DEBUG] Current Session ID: ' . session()->getId());
        error_log('[WanderWise DEBUG] Auth Check Status: ' . (auth()->check() ? 'LOGGED IN' : 'GUEST'));

        if (!auth()->check()) {
            error_log('[WanderWise DEBUG] AdminMiddleware: ACCESS DENIED (Not Logged In)');
            return redirect()->route('admin.login');
        }

        if (!auth()->user()->is_admin) {
            error_log('[WanderWise DEBUG] AdminMiddleware: ACCESS DENIED (Not Admin) for user ID: ' . auth()->id());
            return redirect()->route('admin.login')->withErrors(['email' => 'Akses ditolak. Bukan admin.']);
        }

        error_log('[WanderWise DEBUG] AdminMiddleware: ACCESS GRANTED for user ID: ' . auth()->id());
        return $next($request);
    }
}
