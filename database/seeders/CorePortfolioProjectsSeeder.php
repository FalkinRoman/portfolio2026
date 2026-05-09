<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Портфельные кейсы: каждый проект — свой сидер + fixtures.
 */
class CorePortfolioProjectsSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(BeatLineProjectSeeder::class);
        $this->call(ProstoyogaProjectSeeder::class);
        $this->call(KindleProjectSeeder::class);
        $this->call(ProstocampsProjectSeeder::class);
    }
}
