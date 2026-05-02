<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $projects = Project::published()->get();
        $urls = collect([url('/')])->merge(
            $projects->map(fn (Project $p) => route('project.show', $p))
        );

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
