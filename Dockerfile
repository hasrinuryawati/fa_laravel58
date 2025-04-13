FROM php:7.4

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    autoconf \
    pkg-config \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install zip mbstring bcmath gd intl xml

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
WORKDIR /var/www
COPY . /var/www
COPY .env.example .env

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Serve app
EXPOSE 80
CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=80
