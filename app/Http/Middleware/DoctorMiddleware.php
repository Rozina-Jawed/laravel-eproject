<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          {
        if (!Auth::guard('doctor')->check()) {
            return redirect()->route('doctor.login')->with('error', 'Doctor login required!');
        }
        return $next($request);
    }
    }
}
