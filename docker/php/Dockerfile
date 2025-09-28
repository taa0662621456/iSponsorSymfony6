FROM php:8.3-fpm

RUN apt-get update && apt-get install -y     git unzip libicu-dev libpq-dev libzip-dev zlib1g-dev libpng-dev curl     && docker-php-ext-install intl opcache pdo pdo_pgsql zip gd     && pecl install apcu && docker-php-ext-enable apcu

COPY php.ini /usr/local/etc/php/php.ini
COPY www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/symfony
