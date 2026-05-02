<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'slug', 'name', 'tagline', 'meta_client', 'meta_service', 'meta_date',
        'overview_p1', 'overview_p2', 'overview_p3', 'features', 'accent_line',
        'live_url', 'seo_title', 'seo_description',
        'card_image', 'logo_image', 'banner_image', 'gallery_images',
        'is_published', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'gallery_images' => 'array',
            'is_published' => 'boolean',
        ];
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
