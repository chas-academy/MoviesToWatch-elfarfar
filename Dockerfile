FROM php:8.2-apache

# Enable extensions if needed
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set the working directory to the src folder
WORKDIR /var/www/html/

# Copy application code into the container
COPY src/ /var/www/html/

# Expose port 80
EXPOSE 80