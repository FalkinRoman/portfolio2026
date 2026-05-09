<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * BeatLine: полный текст из прод-админки + медиа из fixtures (перезапись storage при каждом сиде).
 */
class BeatLineProjectSeeder extends Seeder
{
    public function run(): void
    {
        $fixtureBase = database_path('seeders/fixtures/beatline');
        if (! is_dir($fixtureBase)) {
            throw new \RuntimeException('Missing fixtures: '.$fixtureBase);
        }

        $text = [
            'slug' => 'beatline',
            'name' => 'BeatLine',
            'name_en' => 'BeatLine',
            'tagline' => 'Лирика в ритме трека — файлы для стриминга без хаоса.',
            'tagline_en' => 'Lyrics in track rhythm — streaming-ready files without chaos.',
            'meta_client' => 'BeatLine / музыкальные команды',
            'meta_client_en' => 'BeatLine / music teams',
            'meta_service' => "Веб-платформа\nредактор лирики\nинтеграция DSP",
            'meta_service_en' => "Web platform\nlyrics editor\nDSP integration",
            'meta_date' => '2026',
            'meta_date_en' => '2026',
            'overview_p1' => 'BeatLine — сервис для артистов, менеджеров и издателей, где каталог релизов, тексты и синхронная лирика собираются в одном рабочем контуре.',
            'overview_p1_en' => 'BeatLine is a workflow platform for artists, managers and publishers where release catalog, lyrics and synchronized timing are managed in one place.',
            'overview_p2' => 'В продукте реализован поток: артист/релиз/трек → ввод и редактура текста → тайминг под аудио → экспорт LRC/TTML → подготовка пакета для передачи на DSP.',
            'overview_p2_en' => 'The product flow covers artist/release/track setup, lyric editing, timeline marking against audio, LRC/TTML export and DSP delivery payload preparation.',
            'overview_p3' => 'Ключевой результат — управляемый процесс подготовки лирики и таймингов, который масштабируется на несколько артистов и релизов без потери качества.',
            'overview_p3_en' => 'Key outcome: a controllable lyrics-and-timing workflow that scales across multiple artists and releases.',
            'features' => [
                'Каталог артистов, релизов и треков с метаданными',
                'Редактор текста: обычный и синхронный режим',
                'Караоке-разметка строк по аудио в ритме трека',
                'Импорт/экспорт LRC и TTML',
                'Ролевой доступ, статусы и модерация контента',
                'Подготовка payload для передачи на музыкальные площадки',
            ],
            'features_en' => [
                'Catalog of artists, releases and tracks with metadata',
                'Lyrics editor with plain and synchronized modes',
                'Karaoke timing of lines against audio',
                'LRC/TTML import and export',
                'Role-based access and moderation statuses',
                'DSP delivery payload preparation',
            ],
            'accent_line' => 'Единый контур для лирики, синхрона и поставки на стриминговые платформы.',
            'accent_line_en' => 'A single workflow for lyrics, sync timing and streaming delivery.',
            'live_url' => 'https://beatline.ru',
            'seo_title' => null,
            'seo_description' => null,
            'seo_title_en' => 'BeatLine — synced lyrics workflow for streaming platforms',
            'seo_description_en' => 'BeatLine centralizes release catalog, lyric editing, LRC/TTML sync and DSP delivery in one workflow.',
            'is_published' => true,
            'sort_order' => 1,
        ];

        $project = Project::query()->updateOrCreate(['slug' => 'beatline'], $text);

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
