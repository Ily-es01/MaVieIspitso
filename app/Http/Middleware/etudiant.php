<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class etudiant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()  && Auth::User()->hasRole('etudiant')){
            return $next($request);
     }
    abort(403, 'Accès refusé. Vous devez être un étudiant pour accéder à cette page.');
    }
}
