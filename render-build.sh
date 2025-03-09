#!/usr/bin/env bash
set -e

# Update and install necessary dependencies
apt-get update && apt-get install -y unzip

# Install Composer dependencies (if you use Composer)
if [ -f "composer.json" ]; then
    composer install --no-dev --optimize-autoloader
fi

# Set correct permissions
chmod -R 755 /var/www/html

# Ensure public directory is accessible
chmod -R 755 public

echo "Build completed!"
