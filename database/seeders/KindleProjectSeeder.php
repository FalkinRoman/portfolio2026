<?php

namespace Database\Seeders;

use App\Models\Project;
use Database\Seeders\Concerns\ResolvesProjectFixtureImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Kindle: тексты из админки + медиа из fixtures (перезапись storage при каждом сиде).
 */
class KindleProjectSeeder extends Seeder
{
    use ResolvesProjectFixtureImages;

    public function run(): void
    {
        $fixtureBase = database_path('seeders/fixtures/kindle');
        if (! is_dir($fixtureBase)) {
            throw new \RuntimeException('Missing fixtures: '.$fixtureBase);
        }

        $text = [
            'slug' => 'kindle',
            'name' => 'Kindle',
            'name_en' => 'Kindle',
            'tagline' => 'Telegram-бот и dating-приложение с тарифами, оплатой и сильной операционной админкой.',
            'tagline_en' => 'Telegram bot and dating app with subscriptions, payments, and operations-focused admin tools.',
            'meta_client' => 'Kindle / social product',
            'meta_client_en' => 'Kindle / social product',
            'meta_service' => "Telegram Bot + Web/Mobile\r\nплатежи и подписки\r\nадминка и аналитика",
            'meta_service_en' => "Telegram Bot + Web/Mobile\r\npayments and subscriptions\r\nadmin and analytics",
            'meta_date' => '2026',
            'meta_date_en' => '2026',
            'overview_p1' => 'Kindle — продукт в категории знакомств, где Telegram-бот работает как быстрый вход и канал реактивации, а основное приложение закрывает полный пользовательский сценарий.',
            'overview_p1_en' => 'Kindle is a dating product where a Telegram bot handles fast onboarding and reactivation, while the core app covers the full user journey.',
            'overview_p2' => 'Монетизация построена через тарифы и подписки: лимиты на лайки/сообщения, премиум-функции, промо-размещение анкеты, пробные периоды и автопродление.',
            'overview_p2_en' => 'Monetization is implemented through plans and subscriptions: limits on likes/messages, premium features, profile boosts, trial periods, and auto-renewal.',
            'overview_p3' => 'Отдельный фокус — безопасность и качество сообщества: модерация, антиспам и прозрачные правила санкций.',
            'overview_p3_en' => 'A dedicated focus is community safety: moderation, anti-spam heuristics, and transparent sanction reasons.',
            'features' => [
                'Telegram-бот для быстрого старта и реактивации',
                'Анкеты, мэтчинг, фильтры и рекомендации',
                'Чаты и механики вовлечения: лимиты, бусты',
                'Тарифы/подписки: trial, автопродление, промокоды',
                'Платежный контур: webhooks, статусы транзакций',
                'Админка: пользователи, модерация, роли',
                'Аналитика: воронки, retention, конверсии в оплату',
            ],
            'features_en' => [
                'Telegram bot for onboarding and reactivation',
                'Profiles, matching, filters and recommendations',
                'Chat and engagement: limits and boosts',
                'Plans/subscriptions: trial, auto-renewal, promo codes',
                'Payment pipeline: webhooks and transaction states',
                'Admin: users, moderation, roles',
                'Analytics: funnels, retention, payment conversion',
            ],
            'accent_line' => 'Kindle объединяет рост, монетизацию и безопасную социальную механику в одной системе.',
            'accent_line_en' => 'Kindle combines growth, monetization, and safe social mechanics in one system.',
            'live_url' => 'https://t.me',
            'seo_title' => null,
            'seo_description' => null,
            'seo_title_en' => 'Kindle — Telegram-first dating app with subscriptions and analytics',
            'seo_description_en' => 'Dating platform with Telegram bot onboarding, paid plans, moderation admin panel, and product analytics.',
            'is_published' => true,
            'sort_order' => 3,
        ];

        $project = Project::query()->updateOrCreate(['slug' => 'kindle'], $text);

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
        foreach (range(1, 2) as $i) {
            $stem = sprintf('%02d', $i);
            $resolved = $this->resolveFixtureFile($fixtureBase.'/gallery', $stem);
            File::copy($resolved['path'], $destRoot.'/gallery/'.$resolved['filename']);
            $galleryRel[] = 'projects/'.$id.'/gallery/'.$resolved['filename'];
        }

        $project->update([
            'card_image' => 'projects/'.$id.'/'.$rootNames['card'],
            'logo_image' => 'projects/'.$id.'/'.$rootNames['logo'],
            'banner_image' => 'projects/'.$id.'/'.$rootNames['banner'],
            'gallery_images' => $galleryRel,
        ]);
    }
}
