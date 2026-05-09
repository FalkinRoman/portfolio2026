<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = [
        'site_title', 'meta_description', 'og_image', 'hero_bg_image', 'avatar_image', 'home',
    ];

    protected function casts(): array
    {
        return [
            'home' => 'array',
        ];
    }

    public static function current(): self
    {
        $row = static::query()->first();
        if ($row) {
            return $row;
        }

        return static::create([
            'site_title' => 'Фалькин Роман — портфолио',
            'meta_description' => 'Веб и мобильная разработка: лендинги, продукты, MVP.',
            'home' => self::defaultHome(),
        ]);
    }

    /** @return array<string, mixed> */
    public static function defaultHome(): array
    {
        return [
            'review_pill' => '100+ довольных клиентов',
            'hero_lines' => ['Я создаю продукты', 'что работают так же', 'так как вы'],
            'lead_line_1' => 'Создаю цифровые решения,<br class="br-mobile" />которые вовлекают пользователей,',
            'lead_line_2' => 'и каждый экран решает задачу',
            'projects_chip' => 'Проекты',
            'projects_heading' => "Собрано в прод,\nзаточено на рост",
            'projects_lead' => 'От лендингов до продукта: код, скорость и поддержка',
        ];
    }

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
}
