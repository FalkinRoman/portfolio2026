<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'slug', 'name', 'name_en', 'tagline', 'tagline_en', 'meta_client', 'meta_client_en',
        'meta_service', 'meta_service_en', 'meta_date', 'meta_date_en',
        'overview_p1', 'overview_p1_en', 'overview_p2', 'overview_p2_en', 'overview_p3', 'overview_p3_en',
        'features', 'features_en', 'accent_line', 'accent_line_en',
        'live_url', 'seo_title', 'seo_title_en', 'seo_description', 'seo_description_en',
        'card_image', 'logo_image', 'banner_image', 'gallery_images',
        'is_published', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'features_en' => 'array',
            'gallery_images' => 'array',
            'is_published' => 'boolean',
        ];
    }

    /** @return array<int, string> */
    public function displayFeatures(): array
    {
        if (app()->isLocale('en')) {
            $en = $this->features_en;
            if (is_array($en) && count($en) > 0) {
                return $en;
            }
        }

        return $this->features ?? [];
    }

    public function display(string $base): mixed
    {
        if ($base === 'features') {
            return $this->displayFeatures();
        }

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

    public function publicUrl(string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
