#!/usr/bin/env bash
set -e

mkdir -p /var/www/html/storage/framework/{sessions,views,cache} /var/www/html/storage/logs /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "Running database migrations and seeders..."
    php artisan migrate --force || true
    php artisan db:seed --force || true
fi

if [ "${APP_ENV}" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

exec "$@"
