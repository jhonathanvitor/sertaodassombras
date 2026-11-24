# Stage 1: Build Frontend Assets (Vite + Tailwind CSS)
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm ci
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
COPY app ./app
RUN npm run build

# Stage 2: PHP-FPM Application Runtime
FROM php:8.4-fpm-alpine

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    bash \
    curl \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        intl \
        zip \
        opcache

# Copy Composer binary
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy custom PHP config
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

WORKDIR /var/www/html

# Install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# Copy application source
COPY . .
COPY --from=assets /app/public/build ./public/build

# Generate optimized autoloader
RUN composer dump-autoload --optimize --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod +x /var/www/html/docker/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/var/www/html/docker/entrypoint.sh"]
CMD ["php-fpm"]
