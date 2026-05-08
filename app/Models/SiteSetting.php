<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'social_threads_url',
        'social_instagram_url',
        'social_telegram_url',
    ];

    public static function current(): self
    {
        $row = static::query()->first();
        if ($row) {
            return $row;
        }

        return static::create([]);
    }

    /** Для шаблонов: href или # */
    public static function socialHrefs(): object
    {
        $s = static::query()->first();

        return (object) [
            'threads' => ($s?->social_threads_url) ? $s->social_threads_url : '#',
            'instagram' => ($s?->social_instagram_url) ? $s->social_instagram_url : '#',
            'telegram' => ($s?->social_telegram_url) ? $s->social_telegram_url : '#',
        ];
    }
}
