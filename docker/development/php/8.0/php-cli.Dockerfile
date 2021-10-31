ARG DOCKER_IMAGE

FROM ${DOCKER_IMAGE} AS image
# Ubuntu
# Disable interactive install and
# Install base soft for allow apt-add-repository
RUN export DEBIAN_FRONTEND="noninteractive" \
    && apt-get update -qq \
    && apt-get -qqy install software-properties-common apt-utils locales tzdata \
    && apt-get install -y --no-install-recommends libzip-dev unzip procps inotify-tools
#
# set UTC timezone
RUN echo "UTC" > /etc/timezone \
    && rm -f /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata \
    && date
#

FROM ${DOCKER_IMAGE} AS git
# Git
RUN apt-get install -y git zip unzip
RUN apt-get -qqy install build-essential libssl1.0-dev git curl wget libfontconfig1 libxrender1 ghostscript fontconfig nano htop supervisor cron
RUN apt-add-repository ppa:ondrej/php
#

FROM ${DOCKER_IMAGE} AS php
# PHP
RUN apt-get update
RUN apt-get install -qqy php7.4 php7.4-dom php7.4-bcmath php7.4-xml php7.4-mbstring php7.4-gd php7.4-pdo php7.4-mysql php7.4-imagick php7.4-common php7.4-zip php7.4-curl libsqlite3-dev mysql-client openssh-server php7.4-cli php7.4-sqlite php7.4-sqlite3
RUN apt-get update -qq \
    && apt-get -y clean > /dev/null \
    && rm -rf /var/www/* && rm -rf /var/lib/apt/lists/*
#

FROM ${DOCKER_IMAGE} AS composer
# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && composer clear-cache \
    && composer global require hirak/prestissimo

RUN rm -rf /srv/www/* && mkdir /srv/www \
    # Clean up
    && apt-get -y clean > /dev/null \
    && rm -rf /var/www/* && rm -rf /var/lib/apt/lists/* \
    # Start service once so that it properly initializes
    && service php7.4-cli start && service php7.4-cli stop


RUN mv composer.phar /usr/local/bin/composer
RUN /usr/local/bin/composer self-update
ENV COMPOSER_ALLOW_SUPERUSER 1
WORKDIR /var/www/

RUN rm -rf vendor \
    && rm -rf var/cache/* \
    && rm -rf var/log/* \
    && rm -rf var/sessions/*


#

# юилд доходит до этой строки. Хватит!

FROM ${DOCKER_IMAGE} AS redis
# Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis
WORKDIR /var/www/
#

FROM ${DOCKER_IMAGE} AS composerJsonAndLock
COPY ./composer.json ./
#COPY ./composer.json ./composer.lock ./yarn.lock ./
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

#FROM ${DOCKER_IMAGE} AS xdebug
## Xdebug install
#RUN apt-get update && apt-get install -y libpq-dev unzip \
#    && pecl install xdebug-3.0.0 \
#    && docker-php-ext-enable xdebug \
#    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -maxdepth 2 -type f -name xdebug.so)" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
##   && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_mode=req" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
##   && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
##   && echo "xdebug.client_host=host.gateway.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \



FROM ${DOCKER_IMAGE} AS build
# Build
# TODO: в деве монтируем, а не прокидываем
COPY --from=php /var ./
COPY --from=composer /var ./
COPY --from=redis /var ./
COPY --from=composerJsonAndLock /var ./
COPY --from=postgres /var ./
#COPY --from=xdebug /var ./
#COPY .docker/etc/cron.d/base /etc/cron.d/
RUN php -m;
#

USER root
WORKDIR /var/www/
