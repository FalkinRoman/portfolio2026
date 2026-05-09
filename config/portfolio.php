<?php

return [
    'admin_email' => env('ADMIN_EMAIL', 'falkin95@mail.ru'),

    'seo' => [
        'brand_name' => 'Фалькин Роман',
        'site_title' => 'Фалькин Роман — портфолио',
        'meta_description' => 'Разработчик веб и мобильных приложений (React, React Native, Laravel): лендинги, продукты, MVP.',
        /** Превью для Telegram, VK, соцсетей (public/...) — одна картинка на все публичные URL */
        'default_og_image' => 'assets/img/seo/seo.jpg',
        /** Совпадают с реальным файлом seo.jpg (при замене картинки обнови размеры или .env SEO_OG_IMAGE_*) */
        'og_image_width' => (int) env('SEO_OG_IMAGE_WIDTH', 868),
        'og_image_height' => (int) env('SEO_OG_IMAGE_HEIGHT', 627),
        /** Имя сайта в Open Graph */
        'og_site_name' => env('SEO_OG_SITE_NAME', 'Фалькин Роман'),
        /** Полные HTTPS URL для sameAs в JSON-LD (опционально) */
        'same_as_threads' => env('SEO_SAME_AS_THREADS'),
        'same_as_instagram' => env('SEO_SAME_AS_INSTAGRAM'),
        'same_as_telegram' => env('SEO_SAME_AS_TELEGRAM_URL'),
    ],

    /**
     * Реквизиты для юр. документов (152-ФЗ). ИНН / адрес — по желанию (для ИП и т.п.).
     */
    'legal' => [
        'operator_inn' => env('LEGAL_INN'),
        'operator_address' => env('LEGAL_ADDRESS'),
    ],

    /**
     * EN: фиксированные «from $…» (RU — строки в lang/ru).
     */
    'pricing' => [
        'web_usd_from' => (int) env('PRICING_WEB_USD_FROM', 1_900),
        'mobile_usd_from' => (int) env('PRICING_MOBILE_USD_FROM', 3_900),
    ],
];
