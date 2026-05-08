<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotNotifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadFormController extends Controller
{
    public function __construct(
        private TelegramBotNotifier $telegram
    ) {}

    public function contact(Request $request): JsonResponse
    {
        if ($request->filled('_hp')) {
            return response()->json(['ok' => true]);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40', 'required_without:telegram'],
            'telegram' => ['nullable', 'string', 'max:100', 'required_without:phone'],
            'message' => ['required', 'string', 'max:8000'],
        ]);

        $e = fn (string $v) => htmlspecialchars($v, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $locale = app()->getLocale();
        $ip = $request->ip();
        $phone = trim((string) ($data['phone'] ?? ''));
        $tg = trim((string) ($data['telegram'] ?? ''));

        $html = '<b>Новая заявка — форма «Контакты»</b>'."\n"
            .'Язык: '.$e($locale)."\n"
            .'IP: '.$e((string) $ip)."\n\n"
            .'<b>Имя:</b> '.$e($data['name'])."\n"
            .($phone !== '' ? '<b>Телефон:</b> '.$e($phone)."\n" : '')
            .($tg !== '' ? '<b>Telegram:</b> '.$e($tg)."\n" : '')
            .'<b>Сообщение:</b>'."\n".$e($data['message']);

        $this->telegram->sendHtml($html);

        return response()->json(['ok' => true]);
    }

    public function newsletter(Request $request): JsonResponse
    {
        if ($request->filled('_hp')) {
            return response()->json(['ok' => true]);
        }

        $data = $request->validate([
            'phone' => ['nullable', 'string', 'max:40', 'required_without:telegram'],
            'telegram' => ['nullable', 'string', 'max:100', 'required_without:phone'],
        ]);

        $e = fn (string $v) => htmlspecialchars($v, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $locale = app()->getLocale();
        $ip = $request->ip();
        $phone = trim((string) ($data['phone'] ?? ''));
        $tg = trim((string) ($data['telegram'] ?? ''));

        $html = '<b>Заявка — блок «Обновления»</b>'."\n"
            .'Язык: '.$e($locale)."\n"
            .'IP: '.$e((string) $ip)."\n\n"
            .($phone !== '' ? '<b>Телефон:</b> '.$e($phone)."\n" : '')
            .($tg !== '' ? '<b>Telegram:</b> '.$e($tg) : '');

        $this->telegram->sendHtml($html);

        return response()->json(['ok' => true]);
    }
}
