<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureContribuyente
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('auth_profile') !== 'contribuyente') {
            return redirect()->route('contribuyentes.login');
        }
    
        return $next($request);
    }
}
