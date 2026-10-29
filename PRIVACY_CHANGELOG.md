# PRIVACY_CHANGELOG — falkinlab.ru (29.10.2026)

Ветка: `privacy-152-fz-2026-10`  
Оператор: ИП Фалькин Роман Юрьевич

## Что обнаружено

1. На проде в `/privacy` и `/personal-data` оператор отображался как **«ИП falkinlab.ru»** из-за бага:
   `LEGAL_OPERATOR_NAME` fallback → `SEO_OG_SITE_NAME` (= домен).
2. Публичных HTML-форм сбора ПДн нет; связь через Telegram/WhatsApp/email.
3. Веб-аналитика не подключена.
4. В отзывах опубликованы ФИО + фото + роли (4 отзыва) — нужна проверка согласия владельцем.
5. В репозитории остался неиспользуемый `LeadFormController` / JS lead-форм без маршрутов.
6. Внешний шрифт Fontshare; мессенджеры и соцсети — исходящие ссылки.
7. SSH к серверу из среды агента недоступен; деплой — руками с Mac.

## Что изменено в коде

| Файл | Изменение |
|------|-----------|
| `config/portfolio.php` | Оператор по умолчанию «Фалькин Роман Юрьевич»; убран fallback на домен; дата политики 29.10.2026 |
| `resources/views/legal/_personal_data_ru.blade.php` | Полная Политика ПДн по фактической модели (разделы 1–18) |
| `resources/views/legal/_privacy_ru.blade.php` | Уточнён оператор ≠ домен; ссылки на Политику ПДн |
| `resources/views/legal/_personal_data_en.blade.php` | Синхронизация EN |
| `resources/views/legal/_privacy_en.blade.php` | Синхронизация EN |
| `lang/ru/legal.php`, `lang/en/legal.php` | Подписи футера: полные названия документов |
| `resources/views/partials/footer_legal_links.blade.php` | Без структурных изменений (тексты из lang) |
| `public/css/portfolio.css` | Перенос длинных ссылок в футере |
| `resources/views/admin/reviews/form.blade.php` | Предупреждение про согласие на публикацию ПДн |
| `resources/views/admin/projects/form.blade.php` | Разделение кейса vs ПДн клиента |
| `.env.example`, `.env.production.example` | Обязательные `LEGAL_*` |
| `PRIVACY_AUDIT_REVIEWS.md` | Аудит отзывов |
| `PRIVACY_TECH_AUDIT.md` | Технический аудит |
| `PRIVACY_CHANGELOG.md` | Этот файл |
| `scripts/deploy-privacy-on-server.sh` | Команды деплоя на `/srv/portfolio` |
| `PRIVACY_REPORT_2026-10-29.txt` | Итоговый отчёт |

## Какие ПДн сайт собирает сейчас

- Технические: IP, UA, cookie сессии/CSRF, locale в session.
- Через клики на мессенджеры/email — уже вне сайта, по правилам сервиса.
- Публикация: отзывы (ФИО, роль, текст, фото), контент кейсов (в основном продукт/бренд).
- Админка: учётные данные администратора.

## Сторонние сервисы

См. таблицу в `PRIVACY_TECH_AUDIT.md`. Аналитики нет.

## Отзывы, требующие подтверждения согласия

Все 4 отзыва из `ReviewSeeder` / блока testimonials — см. `PRIVACY_AUDIT_REVIEWS.md`.

## Что нельзя сделать автоматически без юридического решения

- Удалять/обезличивать отзывы без решения владельца.
- Утверждать наличие согласия субъектов.
- Делать вывод о законности трансграничной передачи только по названию сервиса.
- Включать формы лидов без отдельного UX согласия и обновления политики.
- Менять уведомление в Роскомнадзор / внутренние акты оператора через сайт.

## Вопросы владельцу

1. На проде в `.env` проставить `LEGAL_OPERATOR_NAME`, `LEGAL_INN`, `LEGAL_OGRNIP`, `LEGAL_POLICY_UPDATED` и `php artisan config:cache`.
2. Подтвердить основания публикации отзывов #1–#4.
3. Нужен ли Fontshare или лучше self-host шрифта (снижение внешних запросов).
4. Удалить/оставить мёртвый `LeadFormController`?
5. Сменить пароль root после передачи в чат.
6. PHP: образ уже 8.3 — при деплое сделать `docker compose ... build --pull` для обновления патчей Alpine/PHP.
