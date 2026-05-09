<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
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

        Project::query()->delete();

        $this->call(SocialSettingsSeeder::class);
        $this->call(CorePortfolioProjectsSeeder::class);
    }
}
