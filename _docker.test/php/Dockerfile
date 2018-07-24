FROM php:7.1-fpm

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y --no-install-recommends apt-utils \
    && apt-get install -y --no-install-recommends \
    libicu-dev \
    libxml2 \
    unzip \
    curl && apt-get clean -y && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl && docker-php-ext-install -j4 intl
RUN docker-php-ext-install -j4 bcmath mbstring

RUN apt-get update \
    && buildDeps="libmemcached-dev zlib1g-dev" \
    && doNotUninstall="libmemcached11 libmemcachedutil2" \
    && apt-get install -y git openssh-client $buildDeps --no-install-recommends \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-source extract \
    && git clone --branch php7 https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached/ \
    && docker-php-ext-install -j4 memcached pdo pdo_mysql zip \
    && docker-php-source delete \
    && apt-mark manual $doNotUninstall \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false $buildDeps

RUN apt-get update && apt-get install -y bash git bash --no-install-recommends && rm -r /var/lib/apt/lists/*

RUN mkdir -p --mode=0777 /var/www/.composer/cache && chmod a+rwx /var/www/.composer/cache
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/bin/composer

COPY entrypoint.sh /
RUN chmod a+x /entrypoint.sh || true

VOLUME /srv/www/application
WORKDIR /srv/www/application

EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]
