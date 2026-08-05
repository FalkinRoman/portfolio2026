<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::query()->delete();
        Storage::disk('public')->deleteDirectory('reviews');

        $items = [
            [
                'name' => 'Паримбетова Данира',
                'name_en' => 'Danira Parimbetova',
                'role' => 'Генеральный директор, Медиа Ленд',
                'role_en' => 'CEO, Media Land',
                'role_mobile' => 'Ген.директор МедиаЛэнд',
                'role_mobile_en' => 'CEO',
                'body' => 'Искали инструмент для работы с текстами и подготовки релизов под российские стриминги — ничего подходящего на рынке не было, решили делать своё. Роман реализовал всё чётко: редактор лирики, синхронизация, выгрузка в нужных форматах для Яндекс Музыки, VK Музыки и Звука. Получили аккуратный продукт с быстрым запуском — сильный аналог MusicMatch, заточенный под наши площадки.',
                'body_en' => 'We needed a tool for lyrics work and release prep for Russian streaming services — nothing on the market fit, so we built our own. Roman shipped it cleanly: lyrics editor, sync, exports in the right formats for Yandex Music, VK Music, and Zvuk. We got a polished product with a fast launch — a strong MusicMatch-style analog tailored to our platforms.',
                'source' => 'assets/img/review/1.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Олеся Рейн',
                'name_en' => 'Olesya Rein',
                'role' => 'практикующий психолог',
                'role_en' => 'practicing psychologist',
                'role_mobile' => 'психолог',
                'role_mobile_en' => 'psychologist',
                'body' => 'Долго откладывала сайт — всё казалось, что это сложно и не совсем моя история. Роман помог разобраться: предложил структуру, объяснил логику каждого блока, и процесс оказался гораздо проще, чем я ожидала. В итоге получился сайт, который точно отражает то, как я работаю — без лишнего, но со всем необходимым: информация обо мне, подход, форматы и стоимость, ответы на частые вопросы, простой путь к записи. Теперь спокойно даю его клиентам.',
                'body_en' => 'I put off launching a site for a long time — it felt complicated and not quite “my story.” Roman helped me make sense of it: proposed a structure, walked me through the purpose of each section, and the process turned out far easier than I expected. The result is a site that really matches how I practice — nothing excessive, but everything that matters: who I am, my approach, formats and pricing, answers to common questions, and a straightforward path to booking. I’m comfortable sharing it with clients now.',
                'source' => 'assets/img/review/2.jpeg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Александра Вихорева',
                'name_en' => 'Alexandra Vikhoreva',
                'role' => 'prosto.yoga и prosto.camps',
                'role_en' => 'prosto.yoga and prosto.camps',
                'role_mobile' => 'prosto.yoga · prosto.camps',
                'role_mobile_en' => 'prosto.yoga · prosto.camps',
                'body' => 'С Романом закрывали и онлайн-курс prosto.yoga, и платформу prosto.camps: в одном кейсе — доступ к практикам, тарифы и личный кабинет, в другом — заявки, оплата, билеты, чек-ины и рассылки по потоку. Оба продукта живут в одной логике: меньше ручной рутины, больше прозрачности по деньгам и участникам. Вёрстка и сценарии понятные без инструкций, доработки по реальным сценариям шли быстро. Если нужен веб, который реально тянет операционку — однозначно рекомендую.',
                'body_en' => 'We worked with Roman on both the prosto.yoga online course and the prosto.camps platform: one product covers practices, plans, and member access; the other handles applications, payments, tickets, check-ins, and cohort messaging. Same mindset in both builds — less spreadsheet chaos, clearer money and participant flows. UX is self-explanatory, iterations on real-world usage were quick. If you need web that actually carries operations, I recommend him without hesitation.',
                'source' => 'assets/img/review/3.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Дмитрий Малащицкий',
                'name_en' => 'Dmitry Malashchitsky',
                'role' => 'основатель Lum, Sri Lanka',
                'role_en' => 'founder of Lum, Sri Lanka',
                'role_mobile' => 'основатель Lum',
                'role_mobile_en' => 'founder, Lum',
                'body' => 'Нужен был не «ещё один сайт про виллы», а нормальный цифровой образ бренда на Шри-Ланке — атмосфера, стиль, бронирование и управление контентом в одном контуре. Роман с командой собрали ребрендинг и систему: сайт, админка, объекты, магазин, мультиязычность и интеграция брони. Получилось цельно — гости видят Lum так, как мы его задумали, а мы правим всё сами. Рекомендую.',
                'body_en' => 'We didn’t need “another villa website” — we needed a real digital brand for Sri Lanka: atmosphere, style, booking and content control in one system. Roman and the team delivered the rebrand and the stack: site, admin, properties, shop, multilingual content and booking integration. It feels coherent — guests see Lum the way we meant it, and we manage everything ourselves. Recommended.',
                'source' => 'assets/img/review/4.jpg',
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            $source = $item['source'];
            unset($item['source']);

            $review = Review::create([
                ...$item,
                'stars' => 5,
                'show_in_avatars' => true,
                'is_published' => true,
            ]);

            $from = public_path($source);
            if (File::isFile($from)) {
                $ext = pathinfo($from, PATHINFO_EXTENSION) ?: 'jpg';
                $dest = 'reviews/'.$review->id.'/avatar.'.$ext;
                Storage::disk('public')->put($dest, File::get($from));
                $review->avatar_image = $dest;
                $review->save();
            }
        }
    }
}
