<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (! $user || strcasecmp($user->email, (string) config('portfolio.admin_email')) !== 0) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
