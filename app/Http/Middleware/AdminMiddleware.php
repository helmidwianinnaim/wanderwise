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
        if (!auth()->check()) {
            Log::warning('AdminMiddleware: User not logged in. Redirecting to login.');
            return redirect()->route('admin.login');
        }

        if (!auth()->user()->is_admin) {
            Log::warning('AdminMiddleware: User is not admin. ID: ' . auth()->id());
            return redirect()->route('admin.login')->withErrors(['email' => 'Akses ditolak. Bukan admin.']);
        }

        Log::info('AdminMiddleware: Access granted for user ID: ' . auth()->id());
        return $next($request);
    }
}
