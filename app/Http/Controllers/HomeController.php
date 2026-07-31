<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Review;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $projects = Project::published()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $reviews = Review::published()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $reviewAvatars = Review::published()
            ->where('show_in_avatars', true)
            ->whereNotNull('avatar_image')
            ->where('avatar_image', '!=', '')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->limit(6)
            ->get();

        return view('home', compact('projects', 'reviews', 'reviewAvatars'));
    }
}
