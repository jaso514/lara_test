<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) { 
            if (Auth::user()->hasRole(['super-admin', 'admin', 'staff'])) {
                return $next($request);
            }
            abort(403, 'This action is unauthorized.');
        }

        return response()->redirectTo('/back_admin/login');
    }
}
