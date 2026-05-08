<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LegalPageController extends Controller
{
    public function privacy(): View
    {
        return view('legal.privacy', [
            'seoTitle' => __('legal.privacy.meta_title'),
            'seoDescription' => __('legal.privacy.meta_description'),
        ]);
    }

    public function personalData(): View
    {
        return view('legal.personal_data', [
            'seoTitle' => __('legal.personal_data.meta_title'),
            'seoDescription' => __('legal.personal_data.meta_description'),
        ]);
    }
}
