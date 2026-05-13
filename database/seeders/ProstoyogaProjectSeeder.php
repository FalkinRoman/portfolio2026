<?php

namespace Database\Seeders;

use App\Models\Project;
use Database\Seeders\Concerns\ResolvesProjectFixtureImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * PROSTO.YOGA: тексты из админки + медиа из fixtures (перезапись storage при каждом сиде).
 */
class ProstoyogaProjectSeeder extends Seeder
{
    use ResolvesProjectFixtureImages;

    public function run(): void
    {
        $fixtureBase = database_path('seeders/fixtures/prostoyoga');
        if (! is_dir($fixtureBase)) {
            throw new \RuntimeException('Missing fixtures: '.$fixtureBase);
        }

        $text = [
            'slug' => 'prostoyoga',
            'name' => 'prosto.yoga',
            'name_en' => 'prosto.yoga',
            'tagline' => 'Видео-курс йоги с личными кабинетами, оплатой и админ-панелью.',
            'tagline_en' => 'Yoga video course with personal accounts, payments and admin panel.',
            'meta_client' => 'prosto.yoga',
            'meta_client_en' => 'prosto.yoga',
            'meta_service' => "Лендинг + LMS\nличный кабинет\nплатежи и CRM",
            'meta_service_en' => "Landing + LMS\npersonal account\npayments and CRM",
            'meta_date' => '2026',
            'meta_date_en' => '2026',
            'overview_p1' => 'prosto.yoga — образовательный продукт в формате онлайн-курса: пользователи проходят практики по расписанию, получают доступ к тарифам и материалам в личном кабинете.',
            'overview_p1_en' => 'prosto.yoga is an online education product where students follow a structured yoga program with scheduled practices and tier-based access.',
            'overview_p2' => 'Платформа объединяет маркетинговый лендинг, регистрацию, оплату, доступ к урокам и админ-контур для управления программой, участниками и контентом.',
            'overview_p2_en' => 'The platform combines marketing landing pages, registration, payment processing, private member areas and an admin panel for managing lessons, participants and content.',
            'overview_p3' => 'В итоге продукт закрывает полный цикл: от первого касания на лендинге до оплаты, обучения и операционного управления курсом внутри одной системы.',
            'overview_p3_en' => 'Result: a full cycle product from landing conversion to payment, learning delivery and admin operations in one system.',
            'features' => [
                'Лендинг с воронкой, тарифами и регистрацией',
                'Личный кабинет с доступом к видео-практикам',
                'Система ролей: участник, куратор, администратор',
                'Онлайн-оплата и автодоступ после подтверждения',
                'Управление контентом курса и уроками через админку',
                'Поддержка чатов/домашних заданий и прогресса',
            ],
            'features_en' => [
                'Landing funnel with plans and registration',
                'Student dashboard with access to video practices',
                'Role model: student, curator, admin',
                'Online payments with automatic access granting',
                'Admin tools for course content management',
                'Support for assignments, chats and progress tracking',
            ],
            'accent_line' => 'Курс, личные кабинеты и монетизация — в единой платформе без разрыва сценариев.',
            'accent_line_en' => 'Course delivery, member areas and monetization in one coherent platform.',
            'live_url' => 'https://prostoyoga.online',
            'seo_title' => null,
            'seo_description' => null,
            'seo_title_en' => 'prosto.yoga — online yoga course platform',
            'seo_description_en' => 'Online yoga course with landing, payments, personal accounts and admin panel for content and student operations.',
            'is_published' => true,
            'sort_order' => 2,
        ];

        $project = Project::query()->updateOrCreate(['slug' => 'prostoyoga'], $text);

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

        // gallery/01..05 в фикстурах — порядок показа как в админке (раньше на диске было 02,03,01,04,05).
        $galleryRel = [];
        foreach (range(1, 5) as $i) {
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
