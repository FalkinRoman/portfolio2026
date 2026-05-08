<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramBotNotifier
{
    public function sendHtml(string $html): bool
    {
        $s = SiteSetting::query()->first();
        $token = $s?->telegram_bot_token;
        $chatId = $s?->telegram_chat_id;

        if ($token === null || $token === '' || $chatId === null || $chatId === '') {
            Log::warning('TelegramBotNotifier: token or chat_id not configured');

            return false;
        }

        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';

        try {
            $res = Http::timeout(15)->asForm()->post($url, [
                'chat_id' => $chatId,
                'text' => $html,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ]);

            if (! $res->successful()) {
                Log::warning('Telegram API error', ['status' => $res->status(), 'body' => $res->body()]);

                return false;
            }

            $json = $res->json();

            return ($json['ok'] ?? false) === true;
        } catch (\Throwable $e) {
            Log::error('TelegramBotNotifier exception', ['message' => $e->getMessage()]);

            return false;
        }
    }
}
