<?php

namespace Database\Seeders;

use App\Models\Project;
use Database\Seeders\Concerns\ResolvesProjectFixtureImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * стопКЕК: экосистема компьютерного клуба (iOS/Android, админка, замки, Electron).
 * Медиа опциональны: если есть fixtures/stopkek — копируются; иначе картинки оставляем null (добавить в админке).
 */
class StopkekProjectSeeder extends Seeder
{
    use ResolvesProjectFixtureImages;

    public function run(): void
    {
        $text = [
            'slug' => 'stopkek',
            'name' => 'стопКЕК',
            'name_en' => 'stopKEK',
            'tagline' => 'Экосистема компьютерного клуба: бронь, оплата, QR, замки и защита ПК — без очереди у администратора.',
            'tagline_en' => 'Computer club ecosystem: booking, payments, QR unlock, smart locks and PC protection — no front-desk queue.',
            'meta_client' => 'стопКЕК / компьютерный клуб',
            'meta_client_en' => 'stopKEK / computer club',
            'meta_service' => "iOS + Android\nадмин-панель бизнеса\nElectron · IoT-замки · платежи",
            'meta_service_en' => "iOS + Android\nbusiness admin panel\nElectron · IoT locks · payments",
            'meta_date' => '2026',
            'meta_date_en' => '2026',
            'overview_p1' => 'стопКЕК — полная цифровизация компьютерного клуба. Гость выбирает зону и ПК в мобильном приложении, пополняет баланс онлайн, разблокирует место по QR на мониторе и открывает электронный замок — клуб работает автономно 24/7, без постоянной роли администратора у стойки.',
            'overview_p1_en' => 'stopKEK is a full digitalization of a computer club. Guests pick a zone and PC in the mobile app, top up balance online, unlock the seat via QR on the monitor and open the electronic lock — the club runs autonomously 24/7 without a permanent front-desk admin.',
            'overview_p2' => 'Экосистема связывает клиентские приложения для iOS и Android, бэкенд, платёжный контур (ЮKassa), управление электронными замками и Electron-подложку на игровых станциях: она защищает компьютер и подключает его к сессии. Отдельная админ-панель закрывает операционку целиком — места и зоны, тарифы, финансы, пользователи, доступы и платежи.',
            'overview_p2_en' => 'The ecosystem connects iOS and Android client apps, the backend, online payments (YooKassa), electronic lock control and an Electron layer on gaming PCs that protects the machine and binds it to the session. A dedicated admin panel covers the full operations stack — seats and zones, pricing, finance, users, access and payments.',
            'overview_p3' => 'Итог — единый цифровой контур от бронирования до разблокировки железа и двери. Сейчас идёт подготовка франшизной модели: упаковка ПО и процессов для масштабирования на другие площадки и продажи программного обеспечения клубам.',
            'overview_p3_en' => 'Result: one digital loop from booking to unlocking hardware and doors. Franchise packaging is underway — software and operating processes ready to scale to other venues and sell as a product to clubs.',
            'features' => [
                'Мобильные приложения iOS и Android: карта зала, бронь, баланс, таймер и продление сессии',
                'Разблокировка ПК по QR и интеграция с электронными замками / доступом в клуб',
                'Electron-подложка на станциях: защита компьютера и электронное подключение к сессии',
                'Админ-панель: места, зоны, тарифы, пользователи, финансы и доступы',
                'Онлайн-оплата и пополнение баланса (ЮKassa)',
                'Автономная работа клуба без очереди у администратора',
                'Подготовка франшизы и тиражирования ПО на другие площадки',
            ],
            'features_en' => [
                'iOS and Android apps: floor map, booking, balance, session timer and extensions',
                'PC unlock via QR plus electronic locks / club door access',
                'Electron kiosk layer: PC protection and session binding',
                'Admin panel: seats, zones, pricing, users, finance and access',
                'Online payments and balance top-up (YooKassa)',
                'Autonomous club operations without a front-desk queue',
                'Franchise packaging and software rollout for other venues',
            ],
            'accent_line' => 'Целая экосистема клуба — от приложения гостя до замка, оплаты и защиты ПК в одном бэкенде.',
            'accent_line_en' => 'A full club ecosystem — from guest app to locks, payments and PC protection on one backend.',
            'live_url' => 'https://apps.apple.com/ru/app/%D1%81%D1%82%D0%BE%D0%BF%D0%BA%D0%B5%D0%BA/id6778068340',
            'seo_title' => 'стопКЕК — экосистема компьютерного клуба',
            'seo_description' => 'iOS/Android, админ-панель, электронные замки, Electron-защита ПК и онлайн-оплата: автономный компьютерный клуб stopkek.site.',
            'seo_title_en' => 'stopKEK — computer club ecosystem',
            'seo_description_en' => 'iOS/Android, admin panel, electronic locks, Electron PC protection and online payments: autonomous computer club at stopkek.site.',
            'is_published' => true,
            'sort_order' => 2,
        ];

        $project = Project::query()->updateOrCreate(['slug' => 'stopkek'], $text);

        $fixtureBase = database_path('seeders/fixtures/stopkek');
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
