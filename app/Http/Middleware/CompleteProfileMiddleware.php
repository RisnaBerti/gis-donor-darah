<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompleteProfileMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah melengkapi profil
        if (auth()->check() && !auth()->user()->profileIsComplete()) {
            return redirect()->route('panel.profile')->with('warning', 'Lengkapi profil Anda terlebih dahulu, untuk mengakses menu lain.');
        }

        return $next($request);
    }
}
