<?php

return [
    'admin_email' => env('ADMIN_EMAIL', 'falkin95@mail.ru'),

    'seo' => [
        'brand_name' => 'Фалькин Роман',
        'site_title' => 'Фалькин Роман — Falkin Lab',
        'meta_description' => 'Falkin Lab: веб, мобильные приложения, CRM и AI от идеи до запуска. Кейсы, процесс и условия на falkinlab.ru.',
        /** Превью для Telegram, WhatsApp, Max, VK (public/...) — одна картинка на все публичные URL */
        'default_og_image' => 'assets/img/seo/og-cover.jpg',
        /** Должны совпадать с реальным файлом (сейчас 1200×630). При замене — обнови размеры / .env */
        'og_image_width' => (int) env('SEO_OG_IMAGE_WIDTH', 1200),
        'og_image_height' => (int) env('SEO_OG_IMAGE_HEIGHT', 630),
        /** Имя сайта в Open Graph */
        'og_site_name' => env('SEO_OG_SITE_NAME', 'Falkin Lab'),
        /** Полные HTTPS URL для sameAs в JSON-LD (опционально) */
        'same_as_threads' => env('SEO_SAME_AS_THREADS'),
        'same_as_instagram' => env('SEO_SAME_AS_INSTAGRAM'),
        'same_as_telegram' => env('SEO_SAME_AS_TELEGRAM_URL'),
    ],

    /**
     * Реквизиты Оператора (ИП) для юр. документов и футера (152-ФЗ).
     */
    'legal' => [
        'operator_name' => env('LEGAL_OPERATOR_NAME', env('SEO_OG_SITE_NAME', 'Фалькин Роман Юрьевич')),
        'operator_inn' => env('LEGAL_INN'),
        'operator_ogrnip' => env('LEGAL_OGRNIP'),
        'policy_updated' => env('LEGAL_POLICY_UPDATED', '03.08.2026'),
    ],

    /**
     * EN: фиксированные «from $…» (RU — строки в lang/ru).
     */
    'pricing' => [
        'web_usd_from' => (int) env('PRICING_WEB_USD_FROM', 1_900),
        'mobile_usd_from' => (int) env('PRICING_MOBILE_USD_FROM', 3_900),
    ],
];
