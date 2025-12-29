<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekVerifikasiEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user() && ! $request->user()->hasVerifiedEmail()) {

            return redirect()->route('profile.index')
                ->with('error', 'Akses ditolak! Silakan verifikasi email Anda terlebih dahulu.');
        }

        return $next($request);
    }
}
