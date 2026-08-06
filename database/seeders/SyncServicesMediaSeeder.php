<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use App\Support\Cms;
use Illuminate\Database\Seeder;

/**
 * Сбрасывает пути картинок услуг на дефолтные assets/img/services/*.
 * Не трогает остальные секции CMS.
 *
 * Внимание: кастомные upload'ы из админки (cms/services/...) будут заменены
 * на файлы из public/assets/img/services — держи там актуальные PNG.
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
