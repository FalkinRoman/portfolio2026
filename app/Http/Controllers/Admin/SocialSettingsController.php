<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialSettingsController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::current();

        return view('admin.social.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $clean = collect($request->only([
            'social_threads_url',
            'social_instagram_url',
            'social_linkedin_url',
        ]))->map(fn ($v) => $v === '' ? null : $v)->all();

        $request->merge($clean);

        $data = $request->validate([
            'social_threads_url' => 'nullable|url|max:500',
            'social_instagram_url' => 'nullable|url|max:500',
            'social_linkedin_url' => 'nullable|url|max:500',
        ]);

        $settings = SiteSetting::current();
        $settings->fill($data);
        $settings->save();

        return redirect()->route('admin.social.edit')->with('ok', 'Ссылки сохранены.');
    }
}
