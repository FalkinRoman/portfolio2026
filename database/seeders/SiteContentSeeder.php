<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use App\Support\Cms;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $row = SiteContent::query()->first();
        if ($row) {
            $row->home = SiteContent::defaultHome();
            $row->site_title = $row->site_title ?: 'Фалькин Роман — портфолио';
            $row->meta_description = 'Веб, CRM, мобильные и AI-решения от идеи до запуска. Кейсы BeatLine, стопКЕК, Lum и другие — на сайте.';
            $row->save();
        } else {
            SiteContent::current();
        }

        Cms::flush();
    }
}
