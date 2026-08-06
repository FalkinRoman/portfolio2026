<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use App\Support\Cms;
use Illuminate\Database\Seeder;

/**
 * Обновляет только блок услуг (картинки CRM/AI/1С и т.д.) из дефолтов —
 * не трогает остальные секции CMS в БД.
 */
class SyncServicesMediaSeeder extends Seeder
{
    public function run(): void
    {
        $row = SiteContent::query()->first() ?? SiteContent::current();
        $home = is_array($row->home) ? $row->home : [];
        $defaults = SiteContent::defaultHome();

        foreach (['ru', 'en'] as $locale) {
            if (! isset($home[$locale]) || ! is_array($home[$locale])) {
                $home[$locale] = $defaults[$locale] ?? [];
            }
            $home[$locale]['services'] = $defaults[$locale]['services'] ?? ($home[$locale]['services'] ?? []);
        }

        $row->home = $home;
        $row->save();
        Cms::flush();
    }
}
