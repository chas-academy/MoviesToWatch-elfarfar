FROM php:8.2-apache

# Enable extensions if needed
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require squizlabs/php_codesniffer --no-progress --no-suggest
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# Set the working directory to the src folder
WORKDIR /var/www/html/src


# Copy application code into the container
COPY ./src /var/www/html/

