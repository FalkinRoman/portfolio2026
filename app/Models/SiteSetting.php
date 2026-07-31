<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'social_threads_url',
        'social_instagram_url',
        'social_telegram_url',
        'social_whatsapp_url',
        'contact_email',
        'contact_phone',
        'studio_logo_path',
        'studio_presentation_path',
        'telegram_bot_token',
        'telegram_chat_id',
    ];

    protected function casts(): array
    {
        return [
            'telegram_bot_token' => 'encrypted',
        ];
    }

    public static function current(): self
    {
        $row = static::query()->first();
        if ($row) {
            return $row;
        }

        return static::create([
            'contact_email' => 'falkin95@mail.ru',
            'social_telegram_url' => 'https://t.me/falroman',
        ]);
    }

    /** Для шаблонов: href или # */
    public static function socialHrefs(): object
    {
        $s = static::query()->first();

        $email = $s?->contact_email ?: 'falkin95@mail.ru';
        $phone = $s?->contact_phone ?: null;
        $wa = $s?->social_whatsapp_url ?: null;
        $tg = $s?->social_telegram_url ?: 'https://t.me/falroman';

        return (object) [
            'threads' => ($s?->social_threads_url) ? $s->social_threads_url : '#',
            'instagram' => ($s?->social_instagram_url) ? $s->social_instagram_url : '#',
            'telegram' => $tg ?: '#',
            'whatsapp' => $wa ?: '#',
            'email' => $email,
            'phone' => $phone,
            'mailto' => $email ? 'mailto:'.$email : '#',
            'tel' => $phone ? 'tel:'.preg_replace('/[^\d+]/', '', $phone) : '#',
        ];
    }

    public function logoUrl(): string
    {
        if ($this->studio_logo_path) {
            return \App\Support\Cms::mediaUrl($this->studio_logo_path) ?: asset('assets/studio/noi-logo.png');
        }

        return asset('assets/studio/noi-logo.png');
    }

    public function presentationUrl(): string
    {
        if ($this->studio_presentation_path) {
            return \App\Support\Cms::mediaUrl($this->studio_presentation_path) ?: asset('assets/studio/noi-presentation.pdf');
        }

        return asset('assets/studio/noi-presentation.pdf');
    }
}
