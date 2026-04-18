    FROM composer:2 AS vendor

    WORKDIR /app
    COPY composer.json composer.lock ./
    RUN composer install \
        --no-dev \
        --prefer-dist \
        --no-interaction \
        --no-progress \
        --optimize-autoloader


    FROM php:8.3-apache

    # System packages and PHP extensions commonly required by Laravel.
    RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
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

    # Point Apache to Laravel public directory.
    ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
    RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
        && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

    # Copy application source.
    COPY . .

    # Copy preinstalled production dependencies.
    COPY --from=vendor /app/vendor ./vendor

    # Required writable directories for Laravel at runtime.
    RUN mkdir -p storage/framework/{cache,sessions,testing,views} storage/logs bootstrap/cache \
        && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
        && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

    EXPOSE 80

    CMD ["apache2-foreground"]
