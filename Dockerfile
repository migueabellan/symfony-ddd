FROM php:8.1-fpm

WORKDIR "/var/www/web"

RUN apt update \
    && apt install -y git vim zip unzip

RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN curl -sS https://get.symfony.com/cli/installer | bash -s - --install-dir /usr/local/bin

COPY etc/infrastructure/php/ /usr/local/etc/php/