<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Csak azt engedjük tovább, aki be van lépve ÉS az ID-ja 1
        // (Vagy írd át arra a számra, ami a te felhasználód ID-ja az adatbázisban)
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Nincs jogosultságod ehhez az oldalhoz.');
    }
}
