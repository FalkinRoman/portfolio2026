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
            'social_telegram_url',
        ]))->map(fn ($v) => $v === '' ? null : $v)->all();

        $request->merge($clean);

        $data = $request->validate([
            'social_threads_url' => 'nullable|url|max:500',
            'social_instagram_url' => 'nullable|url|max:500',
            'social_telegram_url' => 'nullable|url|max:500',
            'telegram_bot_token' => 'nullable|string|max:512',
            'telegram_chat_id' => 'nullable|string|max:128',
        ]);

        $settings = SiteSetting::current();
        $settings->fill([
            'social_threads_url' => $data['social_threads_url'] ?? null,
            'social_instagram_url' => $data['social_instagram_url'] ?? null,
            'social_telegram_url' => $data['social_telegram_url'] ?? null,
        ]);

        $token = isset($data['telegram_bot_token']) ? trim((string) $data['telegram_bot_token']) : '';
        if ($token !== '') {
            $settings->telegram_bot_token = $token;
        }

        $chat = isset($data['telegram_chat_id']) ? trim((string) $data['telegram_chat_id']) : '';
        $settings->telegram_chat_id = $chat === '' ? null : $chat;

        $settings->save();

        return redirect()->route('admin.social.edit')->with('ok', 'Ссылки и уведомления Telegram сохранены.');
    }
}
