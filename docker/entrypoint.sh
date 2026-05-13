#!/bin/sh
set -e
cd /var/www/html

mkdir -p storage/framework/sessions \
  storage/framework/views \
  storage/framework/cache/data \
  storage/app/public \
  storage/logs \
  bootstrap/cache

if [ ! -f database/database.sqlite ]; then
  touch database/database.sqlite
fi

chown -R www-data:www-data storage bootstrap/cache database/database.sqlite 2>/dev/null || true

su www-data -s /bin/sh -c "php artisan migrate --force --no-interaction"
# public/ часто на named volume (root:root) — www-data не может symlink; root может
php artisan storage:link --force --no-interaction 2>/dev/null || true

if [ "$APP_ENV" = "production" ]; then
  # clear от root: иначе www-data не снимет файлы кэша, созданные root (залипает пустой APP_KEY)
  php artisan config:clear --no-interaction 2>/dev/null || true
  chown -R www-data:www-data bootstrap/cache 2>/dev/null || true
  su www-data -s /bin/sh -c "php artisan config:cache --no-interaction" || true
  su www-data -s /bin/sh -c "php artisan route:cache --no-interaction" || true
  su www-data -s /bin/sh -c "php artisan view:cache --no-interaction" || true
fi

exec php-fpm -O
