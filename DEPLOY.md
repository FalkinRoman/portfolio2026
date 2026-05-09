# Деплой на продакшен (portfolio2026)

## 1. Сервер

- PHP **8.2+** с расширениями: `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `curl` (по факту `composer check-platform-reqs`).
- Веб-сервер: **Nginx** + **PHP-FPM** (или Apache + mod_php).
- Для продакшена лучше **MySQL 8** или **PostgreSQL**; SQLite только для локалки.

## 2. Код на сервере

```bash
git clone https://github.com/FalkinRoman/portfolio2026.git
cd portfolio2026
composer install --no-dev --optimize-autoloader
```

## 3. Окружение `.env`

На сервере **не копируйте** локальный `.env`. Создайте новый из шаблона:

```bash
cp .env.production.example .env
nano .env   # или редактор на хостинге
```

Обязательно проверьте:

| Переменная | Зачем |
|------------|--------|
| `APP_KEY` | Выполните `php artisan key:generate` один раз на этом сервере. |
| `APP_ENV=production` | Режим продакшена. |
| `APP_DEBUG=false` | **Всегда false** на бою. |
| `APP_URL` | Полный URL сайта с `https://` (иначе ссылки, OG, storage URL поедут). |
| `DB_*` | Реальная БД; `DB_CONNECTION=mysql` (или `pgsql`) и учётные данные. |
| `ADMIN_EMAIL` | Email, которому разрешён вход в `/admin` (см. `config/portfolio.php`). |
| `ADMIN_PASSWORD` | Только если гоняете `db:seed` на проде — **сильный пароль**, потом можно убрать из `.env`. |
| `SESSION_*` / `CACHE_*` / `QUEUE_*` | На проде часто `database` или `redis` — как настроите инфраструктуру. |
| `MAIL_*` | Если будете слать письма с сервера. |
| `TELEGRAM_BOT_TOKEN` / `TELEGRAM_CHAT_ID` | Уведомления о лидах (если используете). |

Файл `.env` в git **не попадает** — храните копию в секрет-хранилище хостинга.

## 4. Миграции и данные

```bash
php artisan migrate --force
```

Сидер **пересоздаёт** админа и проекты (см. `DatabaseSeeder`). На проде запускайте осознанно:

```bash
php artisan db:seed --force
```

Если не нужно затирать данные — не запускайте `db:seed` повторно; правьте контент через админку.

## 5. Storage и права

```bash
php artisan storage:link
```

Пользователь веб-сервера должен писать в `storage/` и `bootstrap/cache/`:

```bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
```

(имя пользователя `www-data`/`nginx` зависит от ОС/панели.)

## 6. Оптимизация Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

После смены `.env` или кода — при необходимости снова `config:cache` и т.д.

## 7. Очередь и расписание (если включите)

При `QUEUE_CONNECTION=database` (или redis):

```bash
php artisan queue:work
```

В cron для планировщика:

```cron
* * * * * cd /path/to/portfolio2026 && php artisan schedule:run >> /dev/null 2>&1
```

## 8. Nginx (черновик)

Корень сайта — `public/`, не корень репозитория. Пример:

```nginx
root /var/www/portfolio2026/public;
index index.php;
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
location ~ \.php$ {
    fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
}
```

## 9. HTTPS

Включите TLS на прокси/хостинге; в `.env` укажите `APP_URL=https://...`. При необходимости вынесите `TrustProxies` / `URL::forceScheme('https')` по доке Laravel за reverse-proxy.

## 10. После деплоя

- Откройте главную и `/admin` — вход под `ADMIN_EMAIL`.
- Проверьте формы лидов и (если настроено) Telegram.
- Проверьте отображение картинок проектов (`php artisan storage:link` и права на `storage/app/public`).
