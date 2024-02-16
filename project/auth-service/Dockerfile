FROM php:8.3-fpm-alpine3.17

RUN apk update && apk add --no-cache \
    libzip-dev \
    zip \
    git \
    $PHPIZE_DEPS \
    wget

# PHP pdo ext
RUN docker-php-ext-install pdo_mysql zip

# Xdebug ext
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions xdebug

# Настройка Xdebug
ENV PHP_IDE_CONFIG 'serverName=debug.php'
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Xdebug log
RUN mkdir -p /var/log && touch /var/log/xdebug.log && chmod 777 /var/log/xdebug.log

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm"]
