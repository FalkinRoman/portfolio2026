<?php

return [
    'admin_email' => env('ADMIN_EMAIL', 'falkin95@mail.ru'),

    'seo' => [
        'brand_name' => 'Фалькин Роман',
        'site_title' => 'Фалькин Роман — портфолио',
        'meta_description' => 'Веб и мобильная разработка: лендинги, продукты, MVP. Кейсы и контакты.',
        /** Путь относительно public/ для og:image по умолчанию */
        'default_og_image' => 'assets/img/main.png',
    ],

    /**
     * EN: фиксированные «from $…» (RU — строки в lang/ru).
     */
    'pricing' => [
        'web_usd_from' => (int) env('PRICING_WEB_USD_FROM', 2_000),
        'mobile_usd_from' => (int) env('PRICING_MOBILE_USD_FROM', 4_000),
    ],
];
