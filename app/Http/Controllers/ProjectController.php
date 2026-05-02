<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function show(Project $project): View
    {
        if (! $project->is_published) {
            abort(404);
        }

        $brand = config('portfolio.seo.brand_name', 'Фалькин Роман');
        $seoTitle = $project->name.' — кейс | '.$brand;
        $plain = strip_tags((string) ($project->tagline ?: $project->overview_p1 ?: ''));
        $seoDescription = Str::limit(
            $plain !== '' ? $plain : (string) config('portfolio.seo.meta_description', ''),
            180
        );
        $seoOgImage = $project->publicUrl($project->banner_image ?: $project->card_image)
            ?: asset(config('portfolio.seo.default_og_image'));

        return view('project', compact('project', 'seoTitle', 'seoDescription', 'seoOgImage'));
    }
}
