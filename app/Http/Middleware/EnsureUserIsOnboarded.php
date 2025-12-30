<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsOnboarded
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->is_onboarded) {
            if (!$request->routeIs('onboarding.*') && !$request->routeIs('logout')) {
                return redirect()->route('onboarding.index');
            }
        }

        if ($user->is_onboarded) {
            if ($request->routeIs('onboarding.*')) {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
