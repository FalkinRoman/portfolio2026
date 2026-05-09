<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SocialSettingsSeeder extends Seeder
{
    /** @return array<string, string> */
    private function defaults(): array
    {
        $out = [
            'social_threads_url' => env('SOCIAL_THREADS_URL', config('portfolio.seo.same_as_threads')) ?: 'https://www.threads.net/@falroman',
            'social_instagram_url' => env('SOCIAL_INSTAGRAM_URL', config('portfolio.seo.same_as_instagram')) ?: 'https://www.instagram.com/falroman/',
            'social_telegram_url' => env('SOCIAL_TELEGRAM_URL', config('portfolio.seo.same_as_telegram_url')) ?: 'https://t.me/falroman',
            'telegram_bot_token' => env('TELEGRAM_BOT_TOKEN'),
            'telegram_chat_id' => env('TELEGRAM_CHAT_ID'),
        ];

        return array_filter(
            $out,
            static fn ($v) => $v !== null && $v !== ''
        );
    }

    public function run(): void
    {
        $defaults = $this->defaults();

        if ($defaults === []) {
            return;
        }

        $row = SiteSetting::query()->first();

        if (! $row) {
            SiteSetting::create($defaults);

            return;
        }

        $dirty = false;
        foreach ($defaults as $key => $value) {
            if (! filled($row->{$key})) {
                $row->{$key} = $value;
                $dirty = true;
            }
        }

        if ($dirty) {
            $row->save();
        }
    }
}
