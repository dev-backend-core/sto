<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $allowUrl=[
                'admin/active-appointments*',
                'admin/profile*',
                'admin/logout*',
            ];

            if ($user->role === 'mechanic' && ! $request->is($allowUrl)) {
                return redirect()->route('filament.admin.resources.active-appointments.index');
            }
        }

        return $next($request);
    }
}
