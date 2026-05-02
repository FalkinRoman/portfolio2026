<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $body = "User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /login\nDisallow: /register\n\nSitemap: ".url('/sitemap.xml')."\n";

        return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
