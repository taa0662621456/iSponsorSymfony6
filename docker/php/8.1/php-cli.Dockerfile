ARG TZ='UTC'

FROM php:8.1-alpine AS image
# Image
RUN apk update && apk add --no-cache libpq unzip oniguruma-dev gmp-dev postgresql-dev autoconf g++ make \
    && pecl install -o -f redis xdebug-3.0.0 \
    && docker-php-ext-enable redis xdebug \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /tmp/pear \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -maxdepth 2 -type f -name xdebug.so)" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && php -m;

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && /usr/local/bin/composer self-update

ENV COMPOSER_ALLOW_SUPERUSER 1

# Clean
RUN rm -rf /var/cache/apk/* && docker-php-source delete

USER root

WORKDIR /var/www/
