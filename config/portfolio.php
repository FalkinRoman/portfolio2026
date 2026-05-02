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
];
