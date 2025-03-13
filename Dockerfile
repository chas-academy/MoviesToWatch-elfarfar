FROM php:8.2-apache

# Install dependencies for pdo and pdo_sqlite
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Copy the custom Apache config file
COPY ./config/000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable the site
RUN a2ensite 000-default.conf

# Enable necessary Apache modules
RUN a2enmod rewrite

# Copy the PHP source files
COPY ./src /var/www/html

# Expose the port
EXPOSE 80

# Set the command to run Apache in the foreground
CMD ["apache2ctl", "-D", "FOREGROUND"]

# Ensure SQLite database exists and is writable
RUN touch /var/www/html/src/movies.sqlite && chmod 777 /var/www/html/src/movies.sqlite
