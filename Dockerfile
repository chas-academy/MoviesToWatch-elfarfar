FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql 

# Aktivera Apache-rewrite-modul
RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html