# Use the official PHP 7.2 FPM image
FROM php:7.2-fpm

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        nginx

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a user for Composer
RUN useradd -ms /bin/bash composer

# Set ownership of the working directory
RUN chown -R composer:composer /var/www/html

# Switch to the Composer user
USER composer

# Copy only composer files first
COPY composer.json /var/www/html/

# Run composer install to install dependencies
# RUN composer dump-autoload
# Clear Composer cache
RUN php /usr/bin/composer clear-cache

# Switch back to root user to continue with the rest of the setup
USER root

# Set permissions for specific directories
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Additional: Set permissions for other directories if needed
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx configuration file
COPY nginx-config.conf /etc/nginx/sites-available/default

# Expose port 80 (assuming Nginx is configured to listen on port 80)
EXPOSE 80

# CMD ["nginx", "-g", "daemon off;"]  # Ini dihapus

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm
