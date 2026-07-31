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
            $row->meta_description = 'Веб и мобильная разработка · Team Lead FullStack · Noi Studio';
            $row->save();
        } else {
            SiteContent::current();
        }

        Cms::flush();
    }
}
