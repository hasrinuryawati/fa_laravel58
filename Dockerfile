FROM php:7.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql mbstring bcmath gd intl xml

# Install Composer (gunakan image resmi)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
