FROM php:7.2-fpm

LABEL Maintainer="Do Quang Thanh <thanhdoquang@live.com>"

COPY ./php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl

# Install extensions using the helper script provided by the base image
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
