FROM php:8.0.5-apache

RUN apt update && apt install -y apt-utils sendmail mariadb-client pngquant unzip zip libpng-dev libmcrypt-dev git \
  curl libicu-dev libxml2-dev libssl-dev libcurl3-dev libzip-dev

RUN docker-php-ext-install pdo_mysql

#composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
