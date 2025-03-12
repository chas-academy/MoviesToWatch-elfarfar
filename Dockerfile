# Use the official PHP Apache image
FROM php:8.2-apache

# Install necessary PHP extensions (adjust as needed)
RUN docker-php-ext-install pdo pdo_sqlite

# Enable mod_rewrite for Apache (if needed)
RUN a2enmod rewrite

# Set up the working directory
WORKDIR /var/www/html

# Copy your source code into the container
COPY ./src /var/www/html

# Expose the port the container will run on
EXPOSE 80

# Start Apache in the foreground to keep the container running
CMD ["apache2ctl", "-D", "FOREGROUND"]
