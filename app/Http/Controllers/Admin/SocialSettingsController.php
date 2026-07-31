<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'social_whatsapp_url',
            'contact_email',
            'contact_phone',
        ]))->map(fn ($v) => $v === '' ? null : $v)->all();

        $request->merge($clean);

        $data = $request->validate([
            'social_threads_url' => 'nullable|url|max:500',
            'social_instagram_url' => 'nullable|url|max:500',
            'social_telegram_url' => 'nullable|url|max:500',
            'social_whatsapp_url' => 'nullable|url|max:500',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:64',
            'telegram_bot_token' => 'nullable|string|max:512',
            'telegram_chat_id' => 'nullable|string|max:128',
            'studio_logo' => 'nullable|image|max:5120',
            'studio_presentation' => 'nullable|file|mimes:pdf|max:25600',
        ]);

        $settings = SiteSetting::current();
        $settings->fill([
            'social_threads_url' => $data['social_threads_url'] ?? null,
            'social_instagram_url' => $data['social_instagram_url'] ?? null,
            'social_telegram_url' => $data['social_telegram_url'] ?? null,
            'social_whatsapp_url' => $data['social_whatsapp_url'] ?? null,
            'contact_email' => $data['contact_email'] ?? null,
            'contact_phone' => $data['contact_phone'] ?? null,
        ]);

        $token = isset($data['telegram_bot_token']) ? trim((string) $data['telegram_bot_token']) : '';
        if ($token !== '') {
            $settings->telegram_bot_token = $token;
        }

        $chat = isset($data['telegram_chat_id']) ? trim((string) $data['telegram_chat_id']) : '';
        $settings->telegram_chat_id = $chat === '' ? null : $chat;

        if ($request->hasFile('studio_logo')) {
            if ($settings->studio_logo_path) {
                Storage::disk('public')->delete($settings->studio_logo_path);
            }
            $settings->studio_logo_path = $request->file('studio_logo')->store('studio', 'public');
        }

        if ($request->hasFile('studio_presentation')) {
            if ($settings->studio_presentation_path) {
                Storage::disk('public')->delete($settings->studio_presentation_path);
            }
            $settings->studio_presentation_path = $request->file('studio_presentation')->store('studio', 'public');
        }

        $settings->save();

        return redirect()->route('admin.social.edit')->with('ok', 'Контакты и материалы студии сохранены.');
    }
}
