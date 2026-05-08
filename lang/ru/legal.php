<?php

return [
    'common' => [
        'back_home' => 'Назад на главную',
        'footer_privacy' => 'Конфиденциальность',
        'footer_pd' => 'Персональные данные',
        'updated' => 'Документ актуален на :date.',
    ],

    'privacy' => [
        'meta_title' => 'Политика конфиденциальности — '.config('portfolio.seo.brand_name'),
        'meta_description' => 'Политика конфиденциальности персонального сайта: обработка данных, файлы cookie, контакты оператора.',
    ],

    'personal_data' => [
        'meta_title' => 'Обработка персональных данных — '.config('portfolio.seo.brand_name'),
        'meta_description' => 'Политика в отношении обработки персональных данных (152-ФЗ): цели, состав данных, права субъекта.',
    ],

    'forms' => [
        'notice_start' => 'При отправке — вы соглашаетесь с ',
        'notice_and' => ' и ',
        'notice_end' => '.',
        'link_privacy' => 'политикой конфиденциальности',
        'link_pd' => 'обработкой ПДн',
    ],
];
