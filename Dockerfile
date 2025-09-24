# =========================
# 1. Stage: Build (Composer, vendors, cache warmup)
# =========================
FROM php:8.3-fpm-alpine AS app_php_builder

# Установим системные зависимости
RUN apk add --no-cache \
    git unzip libzip-dev libpng-dev libjpeg-turbo-dev libfreetype-dev icu-dev oniguruma-dev postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql intl zip gd opcache

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www/project

# Копируем composer.* и устанавливаем зависимости
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Копируем исходники
COPY . .

# Прогреем кеш Symfony
RUN php bin/console cache:warmup --env=prod

# =========================
# 2. Stage: Runtime
# =========================
FROM php:8.3-fpm-alpine AS app_php_prod

# Установим только нужные расширения
RUN apk add --no-cache \
    libzip libpng libjpeg-turbo freetype icu \
    && docker-php-ext-install pdo pdo_pgsql intl zip gd opcache

WORKDIR /var/www/project

# Копируем результат из build-стадии
COPY --from=app_php_builder /var/www/project /var/www/project

# Настройки PHP
COPY docker/php/prod.ini /usr/local/etc/php/conf.d/app.ini

# Запускаем php-fpm
CMD ["php-fpm"]
