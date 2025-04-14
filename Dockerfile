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

# Set workdir
WORKDIR /var/www

# Copy project files
COPY . /var/www

# Set .env manually (sementara, kalau belum pakai env var di Koyeb)
RUN echo "APP_NAME=Laravel\n\
APP_ENV=production\n\
APP_KEY=\n\
APP_DEBUG=false\n\
APP_URL=https://superb-angeline-1personal0-2ab2cd6b.koyeb.app\n\
OMDB_API_KEY=ba019eb5\n\
LOG_CHANNEL=stack\n\
DB_CONNECTION=sqlite" > /var/www/.env

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Expose port
EXPOSE 8000

# Jalankan Laravel + serve dari folder public
CMD php artisan key:generate --force \
    && php artisan storage:link \
    && php -S 0.0.0.0:8000 -t public
