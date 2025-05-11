# Use an official PHP image with Apache
FROM php:8.1-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy application files to the container
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 10000
EXPOSE 10000

# Start Laravel's built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]