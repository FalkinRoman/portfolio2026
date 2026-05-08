<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::published()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $seoTitle = __('site.projects_catalog.seo_title');
        $seoDescription = __('site.projects_catalog.seo_description');
        $seoOgImage = asset(config('portfolio.seo.default_og_image'));

        return view('projects', compact('projects', 'seoTitle', 'seoDescription', 'seoOgImage'));
    }

    public function show(Project $project): View
    {
        if (! $project->is_published) {
            abort(404);
        }

        $brand = config('portfolio.seo.brand_name', 'Фалькин Роман');
        $name = (string) $project->display('name');
        $customTitle = app()->isLocale('en')
            ? ($project->seo_title_en ?: null)
            : ($project->seo_title ?: null);
        if ($customTitle) {
            $seoTitle = $customTitle.' | '.$brand;
        } else {
            $seoTitle = $name.' — '.__('site.project.case_suffix').' | '.$brand;
        }
        $customDesc = app()->isLocale('en')
            ? ($project->seo_description_en ?: null)
            : ($project->seo_description ?: null);
        if ($customDesc) {
            $seoDescription = Str::limit(strip_tags((string) $customDesc), 180);
        } else {
            $plain = strip_tags((string) ($project->display('tagline') ?: $project->display('overview_p1') ?: ''));
            $seoDescription = Str::limit(
                $plain !== '' ? $plain : (string) config('portfolio.seo.meta_description', ''),
                180
            );
        }
        /* Единое превью (seo.png) для Telegram и соцсетей по всему сайту */
        $seoOgImage = asset(config('portfolio.seo.default_og_image'));

        return view('project', compact('project', 'seoTitle', 'seoDescription', 'seoOgImage'));
    }
}
