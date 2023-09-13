FROM php:8.2.7-fpm

# Install dependencies
RUN apt-get update && apt-get upgrade -y \
    libsqlite3-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install \
    pdo \
    pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer