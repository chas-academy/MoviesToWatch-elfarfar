FROM php:7.4-cli

# Install required packages
RUN apt-get update && apt-get install -y libsqlite3-dev

# Install PDO and PDO_SQLite extensions
RUN docker-php-ext-install pdo pdo_sqlite
