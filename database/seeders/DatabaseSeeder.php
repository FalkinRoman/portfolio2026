<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $email = (string) config('portfolio.admin_email');
        $password = (string) env('ADMIN_PASSWORD', 'changeme');

        User::query()->where('email', $email)->delete();
        User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $staticApp = dirname(base_path()).'/portfolio-app';
        if (! is_dir($staticApp)) {
            $staticApp = base_path('../portfolio-app');
        }

        Project::query()->delete();

        $project = Project::create([
            'slug' => 'growly',
            'name' => 'Growly',
            'tagline' => 'Современный чистый интерфейс: доверие, скорость и конверсия для финансового продукта.',
            'meta_client' => 'Alient Studio',
            'meta_service' => "UI/UX · Framer\nразработка",
            'meta_date' => '21 марта 2024',
            'overview_p1' => 'Growly — продуктовый сайт для финтеха и банкинга: акцент на доверии, безопасности и бесшовном цифровом опыте. Задача — дать платформам, банкам и стартапам в финансах витрину, которая не «кричит», а убеждает: понятная навигация, спокойная типографика, быстрые экраны.',
            'overview_p2' => 'Визуальный язык и сетка заточены под конверсию: блоки доверия, продуктовые сценарии, аккуратные CTA и адаптив «mobile-first». Компоненты UI согласованы по состояниям и отступам; тяжёлая графика не ломает LCP — приоритет отдаём читаемости и отклику интерфейса.',
            'overview_p3' => 'Итог — витрина, которая усиливает бренд в конкурентной нише: понятный оффер, сильный первый экран и согласованный опыт на всех устройствах.',
            'features' => [
                'Чистая, «дорогая» подача без визуального шума — ощущение надёжности бренда.',
                'Навигация и иерархия без трения: пользователь доходит до целевого действия за пару кликов.',
                'Учёт скорости загрузки и предсказуемой работы форм — меньше отказов на мобильных.',
                'Посадочные и продуктовые блоки заточены под лиды и регистрации.',
                'Масштабируемая дизайн-система: банки, нео-брокеры, B2B-сервисы — единая логика модулей.',
            ],
            'accent_line' => '🚀 Growly — где сильный визуал встречается с дисциплиной инженерии и доверием пользователя.',
            'live_url' => null,
            'is_published' => true,
            'sort_order' => 0,
        ]);

        if (is_dir($staticApp)) {
            $pid = $project->id;
            $base = storage_path('app/public/projects/'.$pid);
            File::ensureDirectoryExists($base.'/gallery');

            $map = [
                $staticApp.'/assets/img/projects/growly.png' => $base.'/card.png',
                $staticApp.'/assets/img/projects/logos/growly.svg' => $base.'/logo.svg',
                $staticApp.'/assets/img/case-growly/banner.png' => $base.'/banner.png',
            ];
            foreach ($map as $from => $to) {
                if (is_file($from)) {
                    File::copy($from, $to);
                }
            }
            $gallery = [];
            foreach (['screen-1.png', 'screen-2.png', 'screen-3.png', 'screen-4.png'] as $fn) {
                $from = $staticApp.'/assets/img/case-growly/'.$fn;
                if (is_file($from)) {
                    $dest = $base.'/gallery/'.$fn;
                    File::copy($from, $dest);
                    $gallery[] = 'projects/'.$pid.'/gallery/'.$fn;
                }
            }

            $project->card_image = 'projects/'.$pid.'/card.png';
            $project->logo_image = is_file($base.'/logo.svg') ? 'projects/'.$pid.'/logo.svg' : null;
            $project->banner_image = is_file($base.'/banner.png') ? 'projects/'.$pid.'/banner.png' : null;
            $project->gallery_images = $gallery !== [] ? $gallery : null;
            $project->save();
        }
    }
}
