<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    private const ALLOWED = ['ru', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', config('app.locale', 'ru'));
        if (! in_array($locale, self::ALLOWED, true)) {
            $locale = 'ru';
        }
        app()->setLocale($locale);

        return $next($request);
    }
}
