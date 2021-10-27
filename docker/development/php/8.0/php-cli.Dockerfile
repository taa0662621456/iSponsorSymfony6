ARG DOCKER_IMAGE

FROM ${DOCKER_IMAGE} AS image
# Ubuntu

FROM ${DOCKER_IMAGE} AS php
# PHP
RUN apt-get update && apt-get install -y php
#

FROM ${DOCKER_IMAGE} AS composer
# Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN /usr/local/bin/composer self-update
ENV COMPOSER_ALLOW_SUPERUSER 1
WORKDIR /var/www/
#

FROM ${DOCKER_IMAGE} AS redis
# Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis
WORKDIR /var/www/
#

FROM ${DOCKER_IMAGE} AS composerJsonAndLock
COPY ./composer.json ./composer.lock .yarn.lock ./
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader
RUN yarn install && npm rebuild node-sass
WORKDIR /var/www/
#

FROM ${DOCKER_IMAGE} AS postgres
# Postgres
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql
WORKDIR /var/www/
#

FROM ${DOCKER_IMAGE} AS xdebug
# Xdebug install
RUN apt-get update && apt-get install -y libpq-dev unzip \
    && pecl install xdebug-3.0.0 \
    && docker-php-ext-enable xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -maxdepth 2 -type f -name xdebug.so)" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#   && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_mode=req" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#   && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#   && echo "xdebug.client_host=host.gateway.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \



FROM ${DOCKER_IMAGE} AS build
# Build
# TODO: в деве монтируем, а не прокидываем
COPY --from=php /var ./
COPY --from=composer /var ./
COPY --from=redis /var ./
COPY --from=composerJsonAndLock /var ./
COPY --from=postgres /var ./
COPY --from=xdebug /var ./
RUN php -m;
#

USER root
WORKDIR /var/www/
