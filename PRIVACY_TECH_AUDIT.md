# Технический privacy-аудит falkinlab.ru

Дата: 29.10.2026  
Оператор: ИП Фалькин Роман Юрьевич  
Метод: статический анализ репозитория + проверка публичных URL `/privacy`, `/personal-data`.

## 1. Системы веб-аналитики

**Системы веб-аналитики в текущей версии проекта не обнаружены.**

Не найдены: Яндекс.Метрика, Google Analytics / gtag, Meta Pixel, VK Pixel, Hotjar, Amplitude, Mixpanel и аналогичные tracking-скрипты в Blade/JS/dependencies публичной части.

## 2. Cookies / storage

| Механизм | Назначение | Где |
|----------|------------|-----|
| Laravel session cookie (`falkin-roman-portfolio-session` и аналог по имени APP) | Сессия, CSRF, locale в session | `config/session.php`, middleware |
| XSRF-TOKEN | CSRF | Laravel |
| Session `locale` | Выбор языка RU/EN | `LocaleController` |

`localStorage` / `sessionStorage` в `public/js/portfolio.js` для сбора ПДн **не используются** (обнаружена логика legacy lead-форм, но публичных форм в Blade нет).

## 3. Публичные формы сбора ПДн

| Форма | Статус |
|-------|--------|
| Заявка / контакты / newsletter HTML на публичных страницах | **Отсутствуют** |
| `LeadFormController` + JS `data-lead-form` | Код в репозитории есть, **маршруты в `routes/web.php` не зарегистрированы**, форм в views нет |
| Админ-формы `/admin`, `/login` | Служебные; не публичный сбор лидов |

Связь с оператором: исходящие ссылки Telegram / WhatsApp / email / phone.

## 4. Внешние сервисы / домены

| Сервис | Какие данные | Цель | Файл / компонент | Когда |
|--------|--------------|------|------------------|-------|
| Собственный хостинг `62.113.44.198` / Docker nginx+php | HTTP-запрос, IP, User-Agent, cookie сессии | Отдача сайта, сессия | `docker-compose*.yml`, Laravel | Каждый визит |
| Fontshare `api.fontshare.com` | IP / User-Agent браузера (типичный запрос шрифтов) | Подключение шрифта Geist Sans | `layouts/site.blade.php`, `layouts/case.blade.php` | Загрузка страницы |
| Telegram (`t.me/falroman`) | Данные, которые пользователь отправит в TG | Связь | footer / header / FAQ CTA | Клик по ссылке (уход с сайта) |
| WhatsApp (`wa.me/...` из настроек) | Данные переписки WA | Связь | footer / header | Клик |
| Email (`mailto:` → `ADMIN_EMAIL`, по умолчанию mail.ru) | Данные письма | Связь | footer / legal | Клик |
| Threads / Instagram (sameAs + соцкнопки) | По правилам соцсети | Соцпрофиль оператора | header/footer, JSON-LD | Клик / краулеры |
| Telegram Bot API (если заданы `TELEGRAM_BOT_*`) | Поля заявки + IP (код `LeadFormController`) | Уведомления | `LeadFormController`, env | Только если формы снова включат |

### Для юридической проверки (возможная трансграничная обработка)

Не юридический вывод, а список на оценку владельцем/юристом:

- Fontshare (CDN шрифтов)
- Telegram / WhatsApp
- Threads / Instagram
- Почтовый провайдер адреса `ADMIN_EMAIL` (mail.ru и т.п.)

## 5. Безопасность / секреты в репозитории

| Находка | Риск | Действие |
|---------|------|----------|
| В `.env.example` указаны примерные `LEGAL_INN` / `LEGAL_OGRNIP` / `ADMIN_EMAIL` | Публичные реквизиты ИП — обычно ок; email публичный контакт | Не коммитить реальные `ADMIN_PASSWORD`, bot tokens |
| `LeadFormController` шлёт IP в Telegram | ПДн в канал уведомлений | Не включать формы без согласия + политики |
| На проде (аудит 29.10.2026) оператор отображался как **«ИП falkinlab.ru»** | Юр. ошибка на страницах политики | Исправлено в коде: fallback больше не берёт `SEO_OG_SITE_NAME` |
| Пароль root передан в чат ассистента | Компрометация доступа | **Сменить пароль SSH немедленно** |

Автоматическое удаление истории Git / production-данных **не выполнялось**.

## 6. PHP / инфраструктура (по коду)

- Docker runtime: `php:8.3-fpm-alpine` (`Dockerfile`).
- HTTPS: nginx + Let's Encrypt (ранее renew + hook копирования в `docker/ssl`).
- SSH-доступ агента к серверу 29.10.2026 из среды Cursor **не установился** (timeout / Operation not permitted на :22). Проверку PHP на живом контейнере и деплой нужно выполнить с Mac владельца (скрипт ниже).
