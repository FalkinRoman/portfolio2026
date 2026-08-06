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
            $row->site_title = $row->site_title ?: 'Фалькин Роман — Falkin Lab';
            $row->meta_description = 'Falkin Lab: веб, мобильные приложения, CRM и AI от идеи до запуска. Кейсы, процесс и условия на сайте.';
            $row->save();
        } else {
            SiteContent::current();
        }

        Cms::flush();
    }
}
