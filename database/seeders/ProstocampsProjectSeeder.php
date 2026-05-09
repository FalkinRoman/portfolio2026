<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * PROSTO.Camps: тексты из админки + медиа из fixtures (перезапись storage при каждом сиде).
 */
class ProstocampsProjectSeeder extends Seeder
{
    public function run(): void
    {
        $fixtureBase = database_path('seeders/fixtures/prostocamps');
        if (! is_dir($fixtureBase)) {
            throw new \RuntimeException('Missing fixtures: '.$fixtureBase);
        }

        $text = [
            'slug' => 'prostocamps',
            'name' => 'prosto.camps',
            'name_en' => 'prosto.camps',
            'tagline' => 'Онлайн-платформа йога-кэмпов: расписание, бронирование, оплата и личный кабинет участника.',
            'tagline_en' => 'Online platform for yoga camps: schedule, booking, payments, and participant accounts.',
            'meta_client' => 'PROSTO',
            'meta_client_en' => 'PROSTO',
            'meta_service' => "Веб-платформа\r\nоплата и билеты\r\nадминка и аналитика",
            'meta_service_en' => "Web platform\r\npayments and ticketing\r\nadmin and analytics",
            'meta_date' => '2026',
            'meta_date_en' => '2026',
            'overview_p1' => 'prosto.camps — продукт для организации выездных и онлайн-кэмпов: страница потока, программа дня, спикеры, места и лимиты группы.',
            'overview_p1_en' => 'prosto.camps organizes retreat and online camp experiences: landing for each cohort, daily schedule, speakers, capacity limits, and logistics.',
            'overview_p2' => 'Монетизация через тарифы мест, промокоды и возвраты по правилам. Админка закрывает заявки, чек-ины, рассылки и отчёты по выручке.',
            'overview_p2_en' => 'Monetization uses tiered tickets, promo codes, and refund policies. Admin covers applications, check-ins, messaging, and revenue reporting.',
            'overview_p3' => 'Операционка: быстрые изменения расписания, массовые уведомления и прозрачные правила отмены.',
            'overview_p3_en' => 'Operations-first: schedule changes, bulk notifications, and clear cancellation rules.',
            'features' => [
                'Лендинг потока кэмпа с программой и FAQ',
                'Оплата: карты/СБП, статусы и чеки',
                'Личный кабинет: билет, расписание, материалы',
                'Админка: заявки, лимиты мест, рассылки',
                'Аналитика: воронка, ARPU, источники трафика',
                'Интеграции: CRM/webhook, напоминания в Telegram',
            ],
            'features_en' => [
                'Camp cohort landing with agenda and FAQ',
                'Checkout with cards/SBP and payment states',
                'Member area: ticket, schedule, downloads',
                'Admin: applications, capacity caps, messaging',
                'Analytics: funnel, ARPU, traffic sources',
                'Integrations: CRM/webhooks, Telegram reminders',
            ],
            'accent_line' => 'Кэмпы как продукт: от первого клика до выезда — в одной системе.',
            'accent_line_en' => 'Camps as a product: from first click to arrival — in one system.',
            'live_url' => 'https://prostocamps.ru',
            'seo_title' => null,
            'seo_description' => null,
            'seo_title_en' => 'prosto.camps — yoga camp platform with ticketing',
            'seo_description_en' => 'Camp operations platform: bookings, payments, member portal, admin, and analytics.',
            'is_published' => true,
            'sort_order' => 4,
        ];

        $project = Project::query()->updateOrCreate(['slug' => 'prostocamps'], $text);

        $id = (int) $project->id;
        $destRoot = storage_path('app/public/projects/'.$id);

        if (File::isDirectory($destRoot)) {
            File::deleteDirectory($destRoot);
        }
        File::ensureDirectoryExists($destRoot.'/gallery');

        foreach (['card.png', 'logo.png', 'banner.png'] as $file) {
            $from = $fixtureBase.'/'.$file;
            if (! is_file($from)) {
                throw new \RuntimeException('Missing fixture file: '.$from);
            }
            File::copy($from, $destRoot.'/'.$file);
        }

        $galleryRel = [];
        foreach (range(1, 7) as $i) {
            $name = sprintf('%02d.png', $i);
            $from = $fixtureBase.'/gallery/'.$name;
            if (! is_file($from)) {
                throw new \RuntimeException('Missing gallery fixture: '.$from);
            }
            File::copy($from, $destRoot.'/gallery/'.$name);
            $galleryRel[] = 'projects/'.$id.'/gallery/'.$name;
        }

        $project->update([
            'card_image' => 'projects/'.$id.'/card.png',
            'logo_image' => 'projects/'.$id.'/logo.png',
            'banner_image' => 'projects/'.$id.'/banner.png',
            'gallery_images' => $galleryRel,
        ]);
    }
}
