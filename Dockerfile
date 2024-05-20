# Use PHP 8.3 as base image
FROM php:8.3-cli

# Set working directory
WORKDIR /var/www/html

# Copy project files to container
COPY . .

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set environment variables for Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="/var/www/html/vendor/bin:${PATH}"

# Install all dependencies (including dev dependencies)
RUN composer install --optimize-autoloader

# Expose port 80
EXPOSE 80

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]