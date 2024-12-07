<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use function Illuminate\Log\log;

class PreventDirectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoutes = ['/', '/registernewuser', '/about'];
        if (in_array($request->path(), $allowedRoutes)) {
            return $next($request);
        }
        if (!Auth::check()) {
            \Log::info('Redirecting unauthenticated user', ['path' => $request->path()]);
            return redirect('registernewuser');
        }
        return $next($request);
    }
}
