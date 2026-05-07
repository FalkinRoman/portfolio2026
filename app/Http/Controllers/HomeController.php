<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $projects = Project::published()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->limit(4)
            ->get();

        return view('home', compact('projects'));
    }
}
