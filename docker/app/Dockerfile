# docker/app/Dockerfile
FROM php:8.2-fpm

# Install necessary packages, including MySQL extension
RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    libpq-dev libzip-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
