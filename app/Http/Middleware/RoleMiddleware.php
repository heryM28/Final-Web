<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Pastikan pengguna terautentikasi dan memiliki salah satu peran yang diizinkan
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika pengguna tidak memiliki peran yang diizinkan, arahkan ke halaman error atau login
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
