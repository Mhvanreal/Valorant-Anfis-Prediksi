# -------------------------------------------------------
# Stage 1: PHP/Composer dependencies
# -------------------------------------------------------
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader

# -------------------------------------------------------
# Stage 2: Node.js — build frontend assets
# -------------------------------------------------------
FROM node:20-alpine AS frontend

WORKDIR /app
COPY package.json package-lock.json vite.config.js tailwind.config.js ./
COPY resources ./resources
RUN npm ci --prefer-offline && npm run build

# -------------------------------------------------------
# Stage 3: Production image
# -------------------------------------------------------
FROM php:8.3-apache

# System packages, Python3, and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    python3 \
    python3-pip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        gd \
        mbstring \
        pdo_mysql \
        zip \
        exif \
        opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Point Apache to Laravel public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy application source
COPY . .

# Copy vendor dari stage 1
COPY --from=vendor /app/vendor ./vendor

# Copy hasil build frontend dari stage 2
COPY --from=frontend /app/public/build ./public/build

# Direktori writable untuk Laravel
RUN mkdir -p storage/framework/{cache,sessions,testing,views} \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# PHP opcache recommended settings for production
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.revalidate_freq=60'; \
    echo 'opcache.fast_shutdown=1'; \
} > /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 80

CMD ["apache2-foreground"]
