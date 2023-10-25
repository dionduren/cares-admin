# Use the official PHP 8.1 image as the base image
FROM php:8.1-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \   
    && docker-php-ext-install pdo pdo_pgsql zip

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the Laravel application files into the container
COPY . .

# Install Composer (Dependency Manager for PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install

# Install PostgreSQL client
RUN apt-get install -y postgresql-client

# Expose port 9000 for PHP-FPM (optional)
# EXPOSE 9000

# Start PHP's built-in web server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
