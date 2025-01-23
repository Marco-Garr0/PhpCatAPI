FROM php:8.2-apache

COPY src/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite
