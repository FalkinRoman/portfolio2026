<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = [
        'site_title', 'meta_description', 'og_image', 'hero_bg_image', 'avatar_image', 'home',
    ];

    protected function casts(): array
    {
        return [
            'home' => 'array',
        ];
    }

    public static function current(): self
    {
        $row = static::query()->first();
        if ($row) {
            $home = is_array($row->home) ? $row->home : [];
            if (! isset($home['ru']) || ! is_array($home['ru'])) {
                $row->home = self::defaultHome();
                $row->save();
            }

            return $row;
        }

        return static::create([
            'site_title' => 'Фалькин Роман — портфолио',
            'meta_description' => 'Веб и мобильная разработка: лендинги, продукты, MVP. Team Lead FullStack · Noi Studio.',
            'home' => self::defaultHome(),
        ]);
    }

    /** @return array<string, mixed> */
    public static function defaultHome(): array
    {
        return [
            'ru' => self::defaultLocaleHome('ru'),
            'en' => self::defaultLocaleHome('en'),
        ];
    }

    /** @return array<string, mixed> */
    public static function defaultLocaleHome(string $locale): array
    {
        if ($locale === 'en') {
            return [
                'services' => [
                    'chip' => 'Services',
                    'h2' => "Clear solutions,\nstrong outcomes",
                    'lead' => 'Engineering-first work focused on product and business growth',
                    'items' => [
                        ['title' => 'Web development', 'images' => ['assets/img/services/website-1.png', 'assets/img/services/website-2.png', 'assets/img/services/website-3.png']],
                        ['title' => 'Mobile apps', 'images' => ['assets/img/services/app-1.png', 'assets/img/services/app-2.png', 'assets/img/services/app-3.png']],
                        ['title' => 'CRM systems', 'images' => ['assets/img/services/crm-1.png', 'assets/img/services/crm-2.png', 'assets/img/services/crm-3.png']],
                        ['title' => '1C integrations', 'images' => ['assets/img/services/1c-1.png', 'assets/img/services/1c-2.png', 'assets/img/services/1c-3.png']],
                        ['title' => 'AI integrations', 'images' => ['assets/img/services/ai-1.png', 'assets/img/services/ai-2.png', 'assets/img/services/ai-3.png']],
                        ['title' => 'MVP & prototypes', 'images' => ['assets/img/services/mvp-1.png', 'assets/img/services/mvp-2.png', 'assets/img/services/mvp-3.png']],
                    ],
                ],
                'projects_chrome' => [
                    'chip' => 'Projects',
                    'h2' => "Shipped to production,\ntuned for growth",
                    'lead' => 'From landing pages to products: code, speed, and support',
                ],
                'process' => [
                    'chip' => 'Process',
                    'h2' => 'Getting your work to production is simpler',
                    'lead' => 'Transparent, fast, without extra bureaucracy',
                    'steps' => [
                        ['h' => 'Step 1', 't' => 'Brief and scoping', 'p' => 'We align on goals, format (web or mobile), key screens, and integrations. Here we set a budget range, timeline, and first release scope.'],
                        ['h' => 'Step 2', 't' => 'Iterative development', 'p' => 'Short sprints: design/code, demo, feedback, sign-off. Priorities and status live in one flow so context doesn’t get lost.'],
                        ['h' => 'Step 3', 't' => 'Release and support', 'p' => 'We ship to production (or app stores for mobile), wire up analytics, check metrics, and handle post-release fixes in an agreed support window.'],
                    ],
                ],
                'pricing' => [
                    'chip' => 'Pricing',
                    'h2' => 'Web and mobile development pricing',
                    'lead' => 'Pick a direction for a ballpark on budget, timeline, and scope',
                    'discuss' => 'Discuss a project',
                    'plans' => [
                        [
                            'key' => 'web',
                            'tab' => 'Web development',
                            'title' => 'Web development',
                            'sub' => 'Landing pages, corporate sites, and web apps for real business needs',
                            'hi' => 'Pricing depends on screen count, logic complexity, integrations, and motion/admin needs.',
                            'price_html' => 'from $1,900<span>/ project</span>',
                            'points' => [
                                'Marketing landing page',
                                'Corporate website',
                                'Customer area / web app',
                                'Included: responsive layout, basic SEO, analytics',
                                'Quoted separately: complex integrations, admin, multilingual',
                                'Timeline: typically 2–8 weeks depending on scope',
                            ],
                        ],
                        [
                            'key' => 'mobile',
                            'tab' => 'Mobile development',
                            'title' => 'Mobile development',
                            'sub' => 'iOS/Android apps: from MVP to production release and ongoing support',
                            'hi' => 'Pricing depends on platforms, screens, backend/API role, push, and store release.',
                            'price_html' => 'from $3,900<span>/ project</span>',
                            'points' => [
                                'MVP on React Native (iOS + Android)',
                                'App with account area and API',
                                'App Store / Google Play release — included',
                                'Included: architecture, UI, build, basic metrics/crash reporting',
                                'Quoted separately: chat/video, offline, complex integrations',
                                'Timeline: typically 4–12 weeks',
                            ],
                        ],
                    ],
                ],
                'toolkit' => [
                    'chip' => 'Stack',
                    'h2' => 'A solid stack, predictable delivery',
                    'lead' => 'Tools and practices to take an idea to a working product',
                    'items' => [
                        ['name' => 'React', 'desc' => 'Modern interfaces and scalable web applications', 'icon' => 'assets/icons/stack/react.svg', 'pct' => 90],
                        ['name' => 'React Native', 'desc' => 'Cross-platform apps for iOS and Android', 'icon' => 'assets/icons/stack/reactnative.svg', 'pct' => 88],
                        ['name' => 'Docker', 'desc' => 'Containerization and predictable deploys in any environment', 'icon' => 'assets/icons/stack/docker.svg', 'pct' => 85],
                        ['name' => 'PHP', 'desc' => 'Server-side logic, APIs, and database integrations', 'icon' => 'assets/icons/stack/php.svg', 'pct' => 83],
                        ['name' => 'Claude', 'desc' => 'AI agents, code assistance and product integrations with Claude', 'icon' => 'assets/icons/stack/claude.svg', 'pct' => 82],
                        ['name' => 'Python', 'desc' => 'Automation, backends, and complex problem solving', 'icon' => 'assets/icons/stack/python.svg', 'pct' => 80],
                        ['name' => 'PostgreSQL', 'desc' => 'Relational database design and optimization', 'icon' => 'assets/icons/stack/postgresql.svg', 'pct' => 78],
                        ['name' => 'Kubernetes', 'desc' => 'Container orchestration and production clusters', 'icon' => 'assets/icons/stack/kubernetes.svg', 'pct' => 80],
                    ],
                ],
                'studio' => [
                    'chip' => 'Noi Studio',
                    'h2' => 'Creator & Team Lead FullStack',
                    'lead' => 'AI & Digital Studio — from strategy and design to engineering that moves business metrics',
                    'role_line' => 'Roman Falkin · Team Lead FullStack Development',
                    'body' => 'I own product business logic end-to-end: architecture, frontend, backend, DevOps. At Noi Studio we start from business value — audit digitalization gaps, test hypotheses, then ship — so it’s never development for development’s sake. Strategy, design, and AI into products with measurable outcomes.',
                    'cta_label' => 'View studio presentation',
                ],
                'faq' => [
                    'chip' => 'FAQ',
                    'h2' => 'Common questions before we start',
                    'lead' => 'Process, timelines, payment, and how we collaborate',
                    'more_q' => 'Didn’t find an answer?',
                    'write' => 'Message on Telegram',
                    'items' => [
                        ['q' => 'How does a typical project run?', 'a' => 'We start with a brief and estimate, then lock phases and priorities. From there we iterate: I show intermediate results, we collect feedback, and ship to production quality.'],
                        ['q' => 'What does the “from” price include?', 'a' => 'The baseline covers discovery, build, responsive layout, basic analytics, and release prep. Integrations, heavy admin, multilingual, offline, or unusual flows are quoted separately.'],
                        ['q' => 'How long does development usually take?', 'a' => 'Web projects often take 2–8 weeks; mobile 4–12 weeks. Exact timing depends on scope, content readiness, and review speed.'],
                        ['q' => 'What’s the difference between web and mobile?', 'a' => 'Web is sites and web apps in the browser. Mobile is iOS/Android apps with store release and mobile-specific flows (push, permissions, native APIs).'],
                        ['q' => 'How do we communicate during the project?', 'a' => 'Main channels are Telegram / WhatsApp, plus email for formal decisions. We run video syncs and calls at key milestones.'],
                        ['q' => 'Do you work under contract with staged payment?', 'a' => 'Yes — we can work under a contract with staged payment: scope, deadlines, stage costs, and acceptance criteria are fixed for both sides.'],
                    ],
                ],
                'footer' => [
                    'chip' => 'Contact',
                    'h2' => 'Available 24/7',
                    'lead' => 'Got a brief? Ping a convenient channel — I usually reply within 3–6 hours.',
                    'channels' => 'Channels',
                    'meetings' => 'By agreement I run video calls at key project milestones.',
                    'copy' => '© 2024–2026 Roman Falkin. All rights reserved.',
                ],
                'about' => [
                    'role' => 'Team Lead FullStack Development · Noi Studio',
                    'hi' => 'Hi, I’m Roman Falkin.',
                    'desc' => '7+ years in digital product development: web, mobile and MVP — from idea to production, with a focus on UX and business results. As Team Lead FullStack at Noi Studio I own the full cycle: app & IT infrastructure architecture, fullstack delivery, integrations (including 1C), RBAC, and scaling to App Store / Google Play.',
                    'exp_h' => 'Experience',
                    'exp' => [
                        'Fullstack Web (2019 — present)',
                        'React Native (2021 — present)',
                        'Frontend / Next.js (2022 — present)',
                        'MVPs and prototypes for startups (2020 — present)',
                        'Product business logic, APIs, microservices, payments, and DevOps',
                        '1C:Enterprise integrations — accounting, data exchange, business workflows',
                        '100+ clients in production: landings, LMS, mobile apps, corporate portals',
                    ],
                    'edu_h' => 'Education & stack',
                    'edu' => [
                        'MSU — Master’s in Project Management',
                        'Courses: React, React Native, Node.js, Laravel, Docker, PostgreSQL',
                        'Stack: React, React Native, Next.js, TypeScript, Node.js/NestJS, Laravel/PHP, Python, PostgreSQL, Redis, RabbitMQ/Kafka, Docker, Kubernetes, Nginx, CI/CD, REST/GraphQL/WebSocket, 1C',
                    ],
                ],
            ];
        }

        return [
            'services' => [
                'chip' => 'Услуги',
                'h2' => "Четкие решения,\nсильный результат",
                'lead' => 'Инженерные решения с упором на рост продукта и бизнеса',
                'items' => [
                    ['title' => 'Веб-разработка', 'images' => ['assets/img/services/website-1.png', 'assets/img/services/website-2.png', 'assets/img/services/website-3.png']],
                    ['title' => 'Мобильные приложения', 'images' => ['assets/img/services/app-1.png', 'assets/img/services/app-2.png', 'assets/img/services/app-3.png']],
                    ['title' => 'CRM-системы', 'images' => ['assets/img/services/crm-1.png', 'assets/img/services/crm-2.png', 'assets/img/services/crm-3.png']],
                    ['title' => '1С-интеграции', 'images' => ['assets/img/services/1c-1.png', 'assets/img/services/1c-2.png', 'assets/img/services/1c-3.png']],
                    ['title' => 'AI-интеграции', 'images' => ['assets/img/services/ai-1.png', 'assets/img/services/ai-2.png', 'assets/img/services/ai-3.png']],
                    ['title' => 'MVP и прототипы', 'images' => ['assets/img/services/mvp-1.png', 'assets/img/services/mvp-2.png', 'assets/img/services/mvp-3.png']],
                ],
            ],
            'projects_chrome' => [
                'chip' => 'Проекты',
                'h2' => "Собрано в прод,\nзаточено на рост",
                'lead' => 'От лендингов до продукта: код, скорость и поддержка',
            ],
            'process' => [
                'chip' => 'Процесс',
                'h2' => 'Запуск ваших задач в прод стал проще',
                'lead' => 'Прозрачно, быстро, без лишней бюрократии',
                'steps' => [
                    ['h' => 'Шаг 1', 't' => 'Бриф и оценка задачи', 'p' => 'Разбираем цель, формат (веб или мобайл), ключевые экраны и интеграции. На этом этапе фиксируем ориентир по бюджету, срокам и первому релизу.'],
                    ['h' => 'Шаг 2', 't' => 'Итерационная разработка', 'p' => 'Двигаемся короткими спринтами: дизайн/код, демо, правки, согласование. Приоритеты и статусы ведём в одном потоке, чтобы не терять контекст.'],
                    ['h' => 'Шаг 3', 't' => 'Релиз и сопровождение', 'p' => 'Публикуем в прод (или сторах для мобайла), подключаем аналитику, проверяем метрики и закрываем пост-релизные доработки в согласованном окне поддержки.'],
                ],
            ],
            'pricing' => [
                'chip' => 'Стоимость',
                'h2' => 'Стоимость веб- и мобильной разработки',
                'lead' => 'Выберите направление и получите ориентир по бюджету, срокам и составу работ',
                'discuss' => 'Обсудить проект',
                'plans' => [
                    [
                        'key' => 'web',
                        'tab' => 'Веб-разработка',
                        'title' => 'Веб-разработка',
                        'sub' => 'Лендинги, корпоративные сайты и веб-приложения под задачи бизнеса',
                        'hi' => 'Цена формируется от объёма экранов, сложности логики, интеграций и требований к анимациям/админке.',
                        'price_html' => 'от 180 000 ₽<span>/ проект</span>',
                        'points' => [
                            'Маркетинговый лендинг',
                            'Корпоративный сайт',
                            'Личный кабинет / web app',
                            'В цену входят: адаптив, базовое SEO, аналитика',
                            'Отдельно оцениваются: сложные интеграции, админ-панель, мультиязык',
                            'Срок: обычно 2–8 недель в зависимости от объёма',
                        ],
                    ],
                    [
                        'key' => 'mobile',
                        'tab' => 'Моб. разработка',
                        'title' => 'Мобильная разработка',
                        'sub' => 'Приложения iOS/Android: от MVP до продакшн-релиза и поддержки',
                        'hi' => 'Цена зависит от числа платформ, количества экранов, роли backend/API, push-логики и публикации в сторах.',
                        'price_html' => 'от 320 000 ₽<span>/ проект</span>',
                        'points' => [
                            'MVP на React Native (iOS + Android)',
                            'Приложение с личным кабинетом и API',
                            'Публикация в App Store / Google Play — включена',
                            'В цену входят: архитектура, UI, сборка, базовые метрики/краши',
                            'Отдельно оцениваются: чат/видеосвязь, офлайн-режим, сложные интеграции',
                            'Срок: обычно 4–12 недель',
                        ],
                    ],
                ],
            ],
            'toolkit' => [
                'chip' => 'Технологии',
                'h2' => 'Надёжный стек, предсказуемый результат',
                'lead' => 'Инструменты и практики, чтобы идея дошла до работающего продукта',
                'items' => [
                    ['name' => 'React', 'desc' => 'Современные интерфейсы и масштабируемые веб-приложения', 'icon' => 'assets/icons/stack/react.svg', 'pct' => 90],
                    ['name' => 'React Native', 'desc' => 'Кроссплатформенные приложения для iOS и Android', 'icon' => 'assets/icons/stack/reactnative.svg', 'pct' => 88],
                    ['name' => 'Docker', 'desc' => 'Контейнеризация и предсказуемый деплой в любой среде', 'icon' => 'assets/icons/stack/docker.svg', 'pct' => 85],
                    ['name' => 'PHP', 'desc' => 'Серверная логика, API и интеграции с базами данных', 'icon' => 'assets/icons/stack/php.svg', 'pct' => 83],
                    ['name' => 'Claude', 'desc' => 'AI-агенты, код и продуктовые интеграции с Claude', 'icon' => 'assets/icons/stack/claude.svg', 'pct' => 82],
                    ['name' => 'Python', 'desc' => 'Автоматизация, бэкенд и задачи любой сложности', 'icon' => 'assets/icons/stack/python.svg', 'pct' => 80],
                    ['name' => 'PostgreSQL', 'desc' => 'Проектирование и оптимизация реляционных баз данных', 'icon' => 'assets/icons/stack/postgresql.svg', 'pct' => 78],
                    ['name' => 'Kubernetes', 'desc' => 'Оркестрация контейнеров и продакшн-кластеры', 'icon' => 'assets/icons/stack/kubernetes.svg', 'pct' => 80],
                ],
            ],
            'studio' => [
                'chip' => 'Noi Studio',
                'h2' => 'Создатель и Team Lead FullStack',
                'lead' => 'AI & Digital Studio — стратегия, дизайн и инженерия под измеримый бизнес-результат',
                'role_line' => 'Роман Фалькин · Team Lead FullStack Development',
                'body' => 'Веду продуктовую бизнес-логику от архитектуры до продакшена: frontend, backend, DevOps. В Noi Studio начинаем с ценности для бизнеса — аудит цифровизации, гипотезы, потом код — чтобы это не было разработкой ради разработки. Стратегия, дизайн и AI в решения с измеримым результатом.',
                'cta_label' => 'Смотреть презентацию студии',
            ],
            'faq' => [
                'chip' => 'FAQ',
                'h2' => 'Частые вопросы перед стартом разработки',
                'lead' => 'Коротко о процессах, сроках, оплате и формате взаимодействия',
                'more_q' => 'Не нашли ответ?',
                'write' => 'Напишите в мессенджер',
                'items' => [
                    ['q' => 'Как проходит работа по проекту?', 'a' => 'Стартуем с брифа и оценки, затем фиксируем этапы и приоритеты. Дальше итерационно: показываю промежуточные результаты, собираем фидбек, доводим до продакшн-качества и релиза.'],
                    ['q' => 'Что входит в стоимость «от»?', 'a' => 'В базовую оценку входят проектирование, разработка, адаптив, базовая аналитика и подготовка к релизу. Интеграции, сложная админка, мультиязык, офлайн-режим и нестандартные сценарии считаются отдельно.'],
                    ['q' => 'Сколько обычно занимает разработка?', 'a' => 'Веб-проекты обычно занимают 2–8 недель, мобильные — 4–12 недель. Точный срок зависит от объёма функционала, готовности контента и скорости согласований.'],
                    ['q' => 'В чём разница между веб и мобильной разработкой?', 'a' => 'Веб — это сайты и web-приложения в браузере. Мобайл — приложения для iOS/Android с публикацией в сторах и мобильными сценариями (push, permissions, нативные особенности).'],
                    ['q' => 'Как мы общаемся во время проекта?', 'a' => 'Основная коммуникация — Telegram / WhatsApp, плюс почта для формализации договорённостей. Для синхронизаций проводим видео-встречи и созвоны по этапам.'],
                    ['q' => 'Работаете по договору и этапной оплате?', 'a' => 'Да, можем работать по договору с поэтапной оплатой: фиксируем объём, сроки, стоимость этапов и критерии приёмки, чтобы обеим сторонам было прозрачно.'],
                ],
            ],
            'footer' => [
                'chip' => 'Контакты',
                'h2' => 'На связи 24/7',
                'lead' => 'Есть задача? Напишите в удобный канал — обычно отвечаю в течение 3–6 часов.',
                'channels' => 'Каналы связи',
                'meetings' => 'По согласованию провожу видео-встречи и созвоны по этапам проекта.',
                'copy' => '© 2024–2026 Фалькин Роман. Все права защищены.',
            ],
            'about' => [
                'role' => 'Team Lead FullStack Development · Noi Studio',
                'hi' => 'Привет, я Роман Фалькин.',
                'desc' => '7+ лет в разработке цифровых продуктов: веб, мобайл и MVP — от идеи до продакшена, с фокусом на UX и бизнес-результат. Как Team Lead FullStack в Noi Studio веду полный цикл: архитектура приложений и IT-инфраструктуры, fullstack-разработка, интеграции (включая 1С), RBAC и масштабирование до App Store / Google Play.',
                'exp_h' => 'Опыт',
                'exp' => [
                    'Fullstack Web (2019 — наст. время)',
                    'React Native (2021 — наст. время)',
                    'Frontend / Next.js (2022 — наст. время)',
                    'MVP и прототипы для стартапов (2020 — наст. время)',
                    'Продуктовая бизнес-логика, API, микросервисы, платежи и DevOps',
                    'Интеграции с 1С:Enterprise — учёт, обмен данными, бизнес-контуры',
                    '100+ клиентов в проде: лендинги, LMS, мобильные приложения, корпоративные порталы',
                ],
                'edu_h' => 'Образование и стек',
                'edu' => [
                    'МГУ — магистр «Руководитель проектов»',
                    'Профильные курсы: React, React Native, Node.js, Laravel, Docker, PostgreSQL',
                    'Стек: React, React Native, Next.js, TypeScript, Node.js/NestJS, Laravel/PHP, Python, PostgreSQL, Redis, RabbitMQ/Kafka, Docker, Kubernetes, Nginx, CI/CD, REST/GraphQL/WebSocket, 1С',
                ],
            ],
        ];
    }

    public function publicUrl(?string $path): ?string
    {
        return \App\Support\Cms::mediaUrl($path);
    }
}
