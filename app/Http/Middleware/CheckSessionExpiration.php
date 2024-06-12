<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('user_id_expires_at')) {
            $expiresAt = Session::get('user_id_expires_at');
            if (now()->greaterThan($expiresAt)) {
                Session::forget('user_id');
                Session::forget('user_id_expires_at');
            }
        }

        return $next($request);
    }
}
