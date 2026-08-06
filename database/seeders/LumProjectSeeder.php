<?php

namespace Database\Seeders;

use App\Models\Project;
use Database\Seeders\Concerns\ResolvesProjectFixtureImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Lum: цифровой бренд вилл / бутик-отеля на Шри-Ланке (ребрендинг + сайт + CMS + бронирование).
 * Медиа опциональны: fixtures/lum → storage; иначе картинки в админке.
 */
class LumProjectSeeder extends Seeder
{
    use ResolvesProjectFixtureImages;

    public function run(): void
    {
        $text = [
            'slug' => 'lum',
            'name' => 'Lum',
            'name_en' => 'Lum',
            'tagline' => 'Ребрендинг и цифровизация вилл на Шри-Ланке: новая стилистика, сайт-система и админка под рост.',
            'tagline_en' => 'Rebrand and digitalization of Sri Lanka villas: new visual language, expandable site system and full CMS.',
            'card_blurb' => 'Сеть вилл на Шри-Ланке · бронирование',
            'card_blurb_en' => 'Sri Lanka villas · booking',
            'meta_client' => 'Lum / Ahangama, Sri Lanka',
            'meta_client_en' => 'Lum / Ahangama, Sri Lanka',
            'meta_service' => "Ребрендинг + UI\nсайт-экосистема\nCMS · бронь · магазин",
            'meta_service_en' => "Rebrand + UI\nsite ecosystem\nCMS · booking · shop",
            'meta_date' => '2026',
            'meta_date_en' => '2026',
            'overview_p1' => 'Lum — бутик-пространство у океана в Ахангаме: виллы, residence, ресторан и лайфстайл. Задача была не «просто сверстать лендинг», а собрать цифровой образ бренда: новая стилистика, типографика, визуальный язык и сайт, который передаёт свет, паузу и тропический ритм места.',
            'overview_p1_en' => 'Lum is a boutique oceanfront space in Ahangama: villas, residence, restaurant and lifestyle. The brief was not a one-off landing page, but a digital brand — new styling, type, visual language and a site that carries the light, pause and tropical rhythm of the place.',
            'overview_p2' => 'Сделали совместную работу дизайна и бэкенда: кастомный фронт под бренд, мультиязычность (RU / EN / ZH), каталог объектов (Residence, Villas, Oculus, Ocean), блог, гастрономия, relax/discover и магазин мерча. Бронирование завязано на Exely (Travelline), контент и структура живут в Filament-админке — страницы, секции, виллы, меню, товары, настройки сайта.',
            'overview_p2_en' => 'Design and backend shipped together: a brand-driven front end, RU / EN / ZH locales, property catalog (Residence, Villas, Oculus, Ocean), blog, dining, relax/discover and merch shop. Booking is wired to Exely (Travelline); content and structure live in a Filament admin — pages, sections, villas, menus, products and site settings.',
            'overview_p3' => 'Архитектура заточена под расширение: новые объекты, активности, экскурсии и витрины без ломки системы. Итог — полная цифровая оболочка курорта с управляемым контентом и заделом на рост бренда.',
            'overview_p3_en' => 'The architecture is built to expand: new properties, activities, excursions and storefronts without breaking the system. Result — a full digital shell for the resort with editable content and room for brand growth.',
            'features' => [
                'Ребрендинг и новая стилистика сайта под атмосферу Шри-Ланки',
                'Совместная работа дизайна и бэкенда: визуал + рабочая система',
                'Каталог вилл и пространств: Residence, Villas, Oculus, Lum Ocean',
                'Интеграция бронирования Exely (Travelline)',
                'Магазин мерча с карточками товаров и сценарием заказа',
                'Filament-админка: контент, виллы, меню, блог, товары, настройки',
                'Мультиязычность RU / EN / ZH и масштабируемая CMS-структура',
            ],
            'features_en' => [
                'Rebrand and new site styling tuned to Sri Lanka atmosphere',
                'Design + backend collaboration: visuals and a working system',
                'Property catalog: Residence, Villas, Oculus, Lum Ocean',
                'Exely (Travelline) booking integration',
                'Merch shop with product cards and order flow',
                'Filament admin: content, villas, menus, blog, products, settings',
                'RU / EN / ZH locales and expandable CMS structure',
            ],
            'accent_line' => 'Не лендинг виллы — цифровой бренд курорта: стиль, контент, бронь и рост в одной системе.',
            'accent_line_en' => 'Not a villa landing — a resort digital brand: style, content, booking and growth in one system.',
            'live_url' => null,
            'seo_title' => 'Lum — ребрендинг и сайт вилл на Шри-Ланке',
            'seo_description' => 'Цифровизация Lum в Ahangama: новый бренд, сайт, CMS, бронирование Exely и магазин.',
            'seo_title_en' => 'Lum — Sri Lanka villa rebrand and site system',
            'seo_description_en' => 'Digitizing Lum in Ahangama: new brand, site, CMS, Exely booking and merch shop.',
            'is_published' => true,
            'sort_order' => 3,
        ];

        $project = Project::query()->updateOrCreate(['slug' => 'lum'], $text);

        $fixtureBase = database_path('seeders/fixtures/lum');
        if (! is_dir($fixtureBase)) {
            return;
        }

        $id = (int) $project->id;
        $destRoot = storage_path('app/public/projects/'.$id);

        if (File::isDirectory($destRoot)) {
            File::deleteDirectory($destRoot);
        }
        File::ensureDirectoryExists($destRoot.'/gallery');

        $rootNames = [];
        foreach (['card', 'logo', 'banner'] as $stem) {
            $resolved = $this->resolveFixtureFile($fixtureBase, $stem);
            File::copy($resolved['path'], $destRoot.'/'.$resolved['filename']);
            $rootNames[$stem] = $resolved['filename'];
        }

        $galleryRel = [];
        $galleryDir = $fixtureBase.'/gallery';
        if (is_dir($galleryDir)) {
            foreach (range(1, 12) as $i) {
                $stem = sprintf('%02d', $i);
                try {
                    $resolved = $this->resolveFixtureFile($galleryDir, $stem);
                } catch (\RuntimeException) {
                    break;
                }
                File::copy($resolved['path'], $destRoot.'/gallery/'.$resolved['filename']);
                $galleryRel[] = 'projects/'.$id.'/gallery/'.$resolved['filename'];
            }
        }

        $project->update([
            'card_image' => 'projects/'.$id.'/'.$rootNames['card'],
            'logo_image' => 'projects/'.$id.'/'.$rootNames['logo'],
            'banner_image' => 'projects/'.$id.'/'.$rootNames['banner'],
            'gallery_images' => $galleryRel,
        ]);
    }
}
