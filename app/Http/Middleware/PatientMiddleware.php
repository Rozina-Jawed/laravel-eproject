<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
            if (!Auth::guard('patient')->check()) {
            return redirect()->route('patient.login')->with('error', 'Patient login required!');
        }
        return $next($request);
    }
    }

