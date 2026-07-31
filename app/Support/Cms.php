<?php

namespace App\Support;

use App\Models\SiteContent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class Cms
{
    protected static ?array $cache = null;

    public static function flush(): void
    {
        static::$cache = null;
    }

    /** @return array<string, mixed> */
    public static function localeHome(?string $locale = null): array
    {
        $locale = $locale ?: app()->getLocale();
        $home = static::home();

        if (isset($home[$locale]) && is_array($home[$locale])) {
            return $home[$locale];
        }

        if (isset($home['ru']) && is_array($home['ru'])) {
            return $home['ru'];
        }

        return SiteContent::defaultLocaleHome('ru');
    }

    /** @return array<string, mixed> */
    public static function home(): array
    {
        if (static::$cache !== null) {
            return static::$cache;
        }

        if (! Schema::hasTable('site_contents')) {
            return SiteContent::defaultHome();
        }

        $row = SiteContent::query()->first();
        $home = is_array($row?->home) ? $row->home : [];

        if (! isset($home['ru']) || ! is_array($home['ru'])) {
            $home = SiteContent::defaultHome();
        }

        return static::$cache = $home;
    }

    public static function section(string $key, ?string $locale = null): array
    {
        $data = Arr::get(static::localeHome($locale), $key, []);

        return is_array($data) ? $data : [];
    }

    public static function get(string $path, mixed $default = null, ?string $locale = null): mixed
    {
        return Arr::get(static::localeHome($locale), $path, $default);
    }

    public static function mediaUrl(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }
        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return '/storage/'.ltrim(str_replace('\\', '/', $path), '/');
    }
}
