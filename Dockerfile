FROM php:7.4

# Install system dependencies
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
    && docker-php-ext-install zip pdo pdo_mysql mbstring bcmath gd intl xml

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
