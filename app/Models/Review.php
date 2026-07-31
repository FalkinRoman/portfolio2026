<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name', 'name_en', 'role', 'role_en', 'role_mobile', 'role_mobile_en',
        'body', 'body_en', 'avatar_image', 'stars', 'show_in_avatars',
        'is_published', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'stars' => 'integer',
            'show_in_avatars' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function display(string $base): mixed
    {
        if (app()->isLocale('en')) {
            $enKey = $base.'_en';
            if (array_key_exists($enKey, $this->attributes)) {
                $val = $this->attributes[$enKey];
                if ($val !== null && $val !== '') {
                    return $val;
                }
            }
        }

        return $this->getAttribute($base);
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('is_published', true);
    }

    /** Путь относительно текущего origin (не APP_URL). */
    public function publicUrl(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $path = ltrim(str_replace('\\', '/', $path), '/');

        return '/storage/'.$path;
    }

    public function avatarUrl(): ?string
    {
        return $this->publicUrl($this->avatar_image);
    }
}
