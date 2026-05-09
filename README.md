# portfolio2026

Портфолио и кейсы (Laravel): лендинг, проекты, админка, лиды, локализация RU/EN.

- **Деплой на прод:** см. [DEPLOY.md](DEPLOY.md)
- **Переменные окружения для продакшена:** шаблон [.env.production.example](.env.production.example) — скопируйте в `.env` на сервере и заполните (секреты не коммитить).

```bash
composer install
cp .env.example .env   # локально; на проде — из .env.production.example
php artisan key:generate
php artisan migrate
php artisan db:seed    # опционально: админ + контент (см. DEPLOY.md)
php artisan storage:link
```

Репозиторий: https://github.com/FalkinRoman/portfolio2026
