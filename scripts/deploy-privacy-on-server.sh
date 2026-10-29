#!/usr/bin/env bash
# Запускать НА СЕРВЕРЕ после git pull (каталог /srv/portfolio).
set -euo pipefail
cd /srv/portfolio

echo "==> git"
git fetch origin
git checkout privacy-152-fz-2026-10 || git checkout main
git pull --ff-only

echo "==> .env LEGAL_* (не перезаписывает существующие)"
grep -q '^LEGAL_OPERATOR_NAME=' .env 2>/dev/null || echo 'LEGAL_OPERATOR_NAME="Фалькин Роман Юрьевич"' >> .env
grep -q '^LEGAL_INN=' .env 2>/dev/null || echo 'LEGAL_INN=343904394076' >> .env
grep -q '^LEGAL_OGRNIP=' .env 2>/dev/null || echo 'LEGAL_OGRNIP=322344300069817' >> .env
# обновить имя оператора если было пусто/доменом
sed -i 's/^LEGAL_OPERATOR_NAME=.*/LEGAL_OPERATOR_NAME="Фалькин Роман Юрьевич"/' .env || true
grep -q '^LEGAL_POLICY_UPDATED=' .env 2>/dev/null \
  && sed -i 's/^LEGAL_POLICY_UPDATED=.*/LEGAL_POLICY_UPDATED=29.10.2026/' .env \
  || echo 'LEGAL_POLICY_UPDATED=29.10.2026' >> .env

echo "==> rebuild / restart (патчи PHP alpine)"
docker compose -f docker-compose.yml -f docker-compose.ssl.yml up -d --build

echo "==> config cache"
docker compose -f docker-compose.yml -f docker-compose.ssl.yml exec -T app php artisan config:clear
docker compose -f docker-compose.yml -f docker-compose.ssl.yml exec -T app php artisan config:cache
docker compose -f docker-compose.yml -f docker-compose.ssl.yml exec -T app php artisan view:clear

echo "==> verify"
docker compose -f docker-compose.yml -f docker-compose.ssl.yml exec -T app php -v | head -1
curl -sk https://127.0.0.1/personal-data | grep -o 'ИП [^<]*' | head -5
echo "OK: ожидается «ИП Фалькин Роман Юрьевич», не falkinlab.ru"
