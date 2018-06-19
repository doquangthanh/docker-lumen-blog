FROM ubuntu:16.04

LABEL Maintainer="Do Quang Thanh <thanhdoquang@live.com>"

RUN apt-get update && apt-get install -y software-properties-common language-pack-en-base \
    && LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y php7.2-cli php7.1-common  php7.2-mysql mcrypt curl \
       php7.2-curl php-redis php7.2-mbstring php7.2-xml php7.2-zip php-memcached php-xdebug git nano iputils-ping zip unzip \
    && mkdir /run/php \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Clean up, to free some space
RUN apt-get clean

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www