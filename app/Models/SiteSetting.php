<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'social_threads_url',
        'social_instagram_url',
        'social_linkedin_url',
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
            'linkedin' => ($s?->social_linkedin_url) ? $s->social_linkedin_url : '#',
        ];
    }
}
