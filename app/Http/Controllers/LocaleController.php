<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    private const ALLOWED = ['ru', 'en'];

    public function switch(Request $request, string $locale): RedirectResponse
    {
        if (! in_array($locale, self::ALLOWED, true)) {
            abort(404);
        }
        $request->session()->put('locale', $locale);

        return redirect()->back();
    }
}
