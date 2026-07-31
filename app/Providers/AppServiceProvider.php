<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Support\Cms;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(
            ['partials._home_head', 'partials._home_services', 'partials._home_tail', 'partials.projects_section', 'partials.case_footer', 'partials.i18n_portfolio'],
            function ($view) {
                $contacts = Schema::hasTable('site_settings')
                    ? SiteSetting::socialHrefs()
                    : (object) [
                        'threads' => '#',
                        'instagram' => '#',
                        'telegram' => 'https://t.me/falroman',
                        'whatsapp' => '#',
                        'email' => 'falkin95@mail.ru',
                        'phone' => null,
                        'mailto' => 'mailto:falkin95@mail.ru',
                        'tel' => '#',
                    ];

                $settings = Schema::hasTable('site_settings') ? SiteSetting::current() : null;

                $view->with('social', $contacts);
                $view->with('contacts', $contacts);
                $view->with('siteSettings', $settings);
                $view->with('cms', Cms::localeHome());
            }
        );
    }
}
