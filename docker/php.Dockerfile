#FROM php:8.4-fpm
#MAC OS
FROM --platform=linux/amd64 php:8.4-fpm

# Installing dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    iputils-ping \
    vim \
    telnet \
    libldap2-dev \
    tzdata \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu \
    && docker-php-ext-install pdo pdo_pgsql ldap

#Installing Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Adding Xdebug configuration to php.ini
RUN { \
        echo 'zend_extension=xdebug'; \
        echo '[Xdebug]'; \
        echo 'xdebug.mode=debug'; \
        echo 'xdebug.start_with_request=yes'; \
        echo 'xdebug.client_port=9003'; \
        echo 'xdebug.client_host=host.docker.internal'; \
        echo 'xdebug.log=/var/log/xdebug/xdebug.log'; \
        echo 'xdebug.idekey=PHPSTORM'; \
    } > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ENV PHP_IDE_CONFIG="serverName=docker_cli"
ENV XDEBUG_SESSION=PHPSTORM

# Creating a folder for Xdebug logs
RUN mkdir -p /var/log/xdebug && touch /var/log/xdebug/xdebug.log && chmod 777 /var/log/xdebug/xdebug.log

# APT cleaning
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

