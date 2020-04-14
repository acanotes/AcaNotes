FROM php:7.3-apache

RUN a2enmod rewrite


# Change document root to right folder for api
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY "./opcache.ini-dev" "/usr/local/etc/php/conf.d/opcache.ini"
COPY "./php.ini-development" "$PHP_INI_DIR/php.ini"

# get zip/unzip stuff
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev

# Get the proper extensions
RUN docker-php-ext-install opcache
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install exif
