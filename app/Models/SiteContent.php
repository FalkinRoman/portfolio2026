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
                    'h2' => "Real products.\nReal results.",
                    'lead' => 'From landing pages to complex systems — work already running in business',
                ],
                'process' => [
                    'chip' => 'Process',
                    'h2' => 'How a project runs',
                    'lead' => 'From research to launch — clear stages and control at every step',
                    'steps' => [
                        ['h' => 'Step 1', 't' => 'Research and problem framing', 'p' => 'We unpack the business goal, audience, and usage scenarios. Lock format (site or app), key screens, and integrations. Prototype and architecture review when needed. Outcome: clear scope, budget, and first-launch timeline.'],
                        ['h' => 'Step 2', 't' => 'Build in short sprints', 'p' => 'We ship in iterations: design and code, demo, sign-off, revisions. Priorities and status stay in one flow — what’s done, what’s next, where the risks are. No context lost between stages.'],
                        ['h' => 'Step 3', 't' => 'Launch, polish, and grow', 'p' => 'We put the product live — on the web or in app stores. Analytics go on, we read real metrics, and close follow-up fixes. Then support and growth on an agreed plan.'],
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
                    'h2' => 'When a product needs a strong team',
                    'lead' => 'Noi steps in on complex work — strategy, design, AI and engineering in one loop',
                    'role_line' => 'Roman Falkin · Team Lead FullStack Development',
                    'body' => 'If the scope is bigger than one fullstack, we assemble the team: research and hypotheses, UX/UI, frontend, backend, and growth after launch. I lead the engineering track as Team Lead. The deck shows how the studio works, who’s on the team, and how we go from idea to product growth.',
                    'cta_label' => 'View studio presentation',
                ],
                'faq' => [
                    'chip' => 'FAQ',
                    'h2' => 'Common questions before we start',
                    'lead' => 'Process, timelines, pricing, and when we bring in the Noi team',
                    'more_q' => 'Didn’t find an answer?',
                    'write' => 'Message on Telegram',
                    'items' => [
                        [
                            'q' => 'How does a project run?',
                            'a' => 'Three stages: research and problem framing, build in short sprints with demos and sign-offs, then launch, polish, and growth. At every step priorities, timelines, and the next outcome stay clear.',
                        ],
                        [
                            'q' => 'What’s the difference between Falkin Lab and Noi Studio?',
                            'a' => 'Falkin Lab is for a strong fullstack end-to-end: from research to launch. Noi Studio steps in on complex work that needs a team — strategy, design, AI, and engineering. I lead the engineering track as Team Lead FullStack.',
                        ],
                        [
                            'q' => 'What kinds of work do you take on?',
                            'a' => 'Sites and web services, mobile apps, CRM, 1C integrations, AI solutions, Telegram Mini Apps, MVPs and prototypes. If the brief spans several areas, we’ll map it and propose the right setup.',
                        ],
                        [
                            'q' => 'What does the “from” price include?',
                            'a' => 'The baseline covers discovery, build, responsive layout, basic analytics, and launch prep. Integrations, heavy admin, multilingual, offline, or unusual flows are quoted separately.',
                        ],
                        [
                            'q' => 'How long does development usually take?',
                            'a' => 'Web projects usually take 2–8 weeks; mobile 4–12 weeks. Timing depends on scope, content readiness, and how fast we align on reviews.',
                        ],
                        [
                            'q' => 'How do we communicate during the project?',
                            'a' => 'Main channel is Telegram or WhatsApp — I reply personally and fast. Email for formal decisions. We can jump on a call whenever the brief needs it.',
                        ],
                        [
                            'q' => 'Do you work under contract with staged payment?',
                            'a' => 'Yes. We lock scope, timelines, stage costs, and acceptance criteria so both sides stay clear.',
                        ],
                        [
                            'q' => 'What happens after launch?',
                            'a' => 'We turn on analytics, read the metrics, and close follow-up fixes. Then support and growth on an agreed plan: new features, optimizations, and ongoing care.',
                        ],
                    ],
                ],
                'footer' => [
                    'chip' => 'Contact',
                    'h2' => 'Available 24/7',
                    'lead' => 'Have a project? Message any channel — I reply personally and fast.',
                    'channels' => 'Channels',
                    'meetings' => 'Happy to jump on a call to walk through the brief when useful.',
                    'copy' => '© 2024–2026 Roman Falkin. All rights reserved.',
                ],
                'about' => [
                    'role' => 'Falkin Lab · product from idea to production',
                    'hi' => 'Hi, I’m Roman Falkin.',
                    'desc' => 'I run Falkin Lab — a digital product laboratory: I research the business problem, design architecture and UX, and ship web, Telegram Mini Apps, mobile and AI solutions to production. Not code for code’s sake — a product people actually use. In parallel, as Team Lead FullStack at Noi Studio I own the full cycle: integrations (including 1C), infrastructure, and App Store / Google Play releases.',
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
                'h2' => "Реальные продукты.\nРеальные результаты.",
                'lead' => 'От лендингов до сложных систем — то, что уже в работе у бизнеса',
            ],
            'process' => [
                'chip' => 'Процесс',
                'h2' => 'Как проходит работа над проектом',
                'lead' => 'От исследования задачи до запуска — с ясными этапами и контролем на каждом шаге',
                'steps' => [
                    ['h' => 'Шаг 1', 't' => 'Исследование и постановка задачи', 'p' => 'Разбираем бизнес-цель, аудиторию и сценарии использования. Фиксируем формат (сайт или приложение), ключевые экраны, интеграции. При необходимости — прототип и оценка архитектуры. На выходе: понятный объём, бюджет и сроки первого запуска.'],
                    ['h' => 'Шаг 2', 't' => 'Разработка короткими спринтами', 'p' => 'Собираем продукт итерациями: дизайн и код, демо, согласование, правки. Приоритеты и статусы ведём в одном потоке — видно, что сделано, что дальше и где риски. Без потери контекста между этапами.'],
                    ['h' => 'Шаг 3', 't' => 'Запуск, доработки и развитие', 'p' => 'Выводим продукт в работу — на сайт или в магазины приложений. Подключаем аналитику, смотрим реальные метрики и закрываем доработки. Дальше — поддержка и развитие по согласованному плану.'],
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
                'h2' => 'Когда продукту нужна сильная команда',
                'lead' => 'Noi подключаем к сложным задачам — стратегия, дизайн, AI и разработка в одном контуре',
                'role_line' => 'Роман Фалькин · Team Lead FullStack Development',
                'body' => 'Если объём больше, чем один fullstack, собираем команду: аналитика и гипотезы, UX/UI, frontend, backend и развитие после запуска. Я веду инженерный контур как Team Lead. В презентации — как устроена студия, кто в команде и как идём от идеи до роста продукта.',
                'cta_label' => 'Смотреть презентацию студии',
            ],
            'faq' => [
                'chip' => 'FAQ',
                'h2' => 'Частые вопросы перед стартом',
                'lead' => 'Процесс, сроки, оплата и когда подключаем команду Noi',
                'more_q' => 'Не нашли ответ?',
                'write' => 'Напишите в мессенджер',
                'items' => [
                    [
                        'q' => 'Как проходит работа над проектом?',
                        'a' => 'Три этапа: исследование и постановка задачи, разработка короткими спринтами с демо и согласованиями, затем запуск, доработки и развитие. На каждом шаге видно приоритеты, сроки и следующий результат.',
                    ],
                    [
                        'q' => 'Чем Falkin Lab отличается от Noi Studio?',
                        'a' => 'Falkin Lab — когда нужен сильный fullstack под ключ: от исследования до запуска. Noi Studio подключаем к сложным задачам, где нужна команда — стратегия, дизайн, AI и разработка. Я веду инженерный контур как Team Lead FullStack.',
                    ],
                    [
                        'q' => 'С какими задачами вы работаете?',
                        'a' => 'Сайты и веб-сервисы, мобильные приложения, CRM, интеграции с 1С, AI-решения, Telegram Mini Apps, MVP и прототипы. Если задача на стыке нескольких направлений — разберём и предложим формат работы.',
                    ],
                    [
                        'q' => 'Что входит в стоимость «от»?',
                        'a' => 'В базовую оценку входят проектирование, разработка, адаптив, базовая аналитика и подготовка к запуску. Интеграции, сложная админка, мультиязык, офлайн-режим и нестандартные сценарии считаются отдельно.',
                    ],
                    [
                        'q' => 'Сколько обычно занимает разработка?',
                        'a' => 'Веб-проекты обычно 2–8 недель, мобильные — 4–12 недель. Срок зависит от объёма функционала, готовности материалов и скорости согласований.',
                    ],
                    [
                        'q' => 'Как мы общаемся во время проекта?',
                        'a' => 'Основной канал — Telegram или WhatsApp: отвечаю лично и быстро. Почта — для формальных договорённостей. Если нужно — созвонимся и разберём задачу голосом.',
                    ],
                    [
                        'q' => 'Работаете по договору и этапной оплате?',
                        'a' => 'Да. Фиксируем объём, сроки, стоимость этапов и критерии приёмки — чтобы обеим сторонам было прозрачно.',
                    ],
                    [
                        'q' => 'Что происходит после запуска?',
                        'a' => 'Подключаем аналитику, смотрим метрики и закрываем доработки. Дальше — поддержка и развитие по согласованному плану: новые функции, оптимизации, сопровождение.',
                    ],
                ],
            ],
            'footer' => [
                'chip' => 'Контакты',
                'h2' => 'На связи 24/7',
                'lead' => 'Есть задача? Напишите в удобный канал — отвечаю лично и быстро.',
                'channels' => 'Каналы связи',
                'meetings' => 'По задачам проекта могу созвониться и разобрать детали голосом.',
                'copy' => '© 2024–2026 Фалькин Роман. Все права защищены.',
            ],
            'about' => [
                'role' => 'Falkin Lab · продукт от идеи до прода',
                'hi' => 'Привет, я Роман Фалькин.',
                'desc' => 'Веду Falkin Lab — лабораторию цифровых продуктов: исследую задачу бизнеса, проектирую архитектуру и UX, собираю веб, Telegram Mini Apps, мобайл и AI-решения до продакшена. Не код ради кода — продукт, которым реально пользуются. Параллельно как Team Lead FullStack в Noi Studio веду полный цикл: интеграции (включая 1С), инфраструктура и релизы в App Store / Google Play.',
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
