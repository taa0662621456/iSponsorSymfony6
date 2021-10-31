ARG DOCKER_IMAGE
FROM ${DOCKER_IMAGE} AS ubuntu
# Ubuntu
# FROM php:8.0.0rc1-fpm
# https://github.com/jtreminio/php-docker
# https://www.tecmint.com/install-php-8-on-ubuntu/
# https://github.com/dyarleniber/docker-php
# Ubuntu 20.01 (Focal)
  #Ubuntu 20.10 (Groovy)
# https://www.colinodell.com/blog/202011/how-install-php-80
# https://github.com/spryker/docker-php
# https://stackoverflow.com/questions/66951256/i-am-not-able-to-install-mbstring-using-docker-file

FROM php:8.0.3-cli-alpine AS php
# PHP
RUN apt-get update && apt-get install -y unzip \
#COPY php.ini /var //TODO: прокинуть php.ini, чтобы в него потом писать настройки
WORKDIR /var/www/
#

FROM php:8.0.3-cli-alpine AS opcache
# Opcache
RUN apt-get update && apt-get install opcache \
WORKDIR /var/www/
#

FROM php:8.0.3-cli-alpine AS composer
# Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN /usr/local/bin/composer self-update
ENV COMPOSER_ALLOW_SUPERUSER 1
WORKDIR /var/www/
#

FROM php:8.0.3-cli-alpine AS redis
# Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis
WORKDIR /var/www/
#

FROM php:8.0.3-cli-alpine AS composerJsonAndLock
# Copy and install
WORKDIR /var
COPY ./composer.json ./composer.lock ./
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader
WORKDIR /var/www/
#

FROM node:12.7-alpine AS node
#
WORKDIR /var
COPY ./package.json ./yarn.lock ./
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN yarn install && npm rebuild node-sass
RUN npm run build
WORKDIR /var/www/
#

FROM php:8.0.3-cli-alpine AS postgresAndOpcache
# Postgres and Opcache install
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql opcache
WORKDIR /var/www/
#

FROM php:8.0.3-cli-alpine AS build
# Build
ENV APP_ENV prod
RUN php bin/console assets:install
RUN php bin/console cache:warmup \
    && chown -R www-data:www-data ./var
WORKDIR /var
COPY --from=php /var ./
COPY --from=composer /var ./
COPY --from=redis /var ./
COPY --from=composerJsonAndLock /var ./
COPY --from=postgresAndOpcache /var ./
RUN php -m;
#

ENV COMPOSER_ALLOW_SUPERUSER 1
#USER root
WORKDIR /var/www/
