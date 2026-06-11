FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    bash git curl zip unzip \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    libxml2-dev oniguruma-dev libzip-dev icu-dev

RUN docker-php-ext-configure gd \
      --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) \
      pdo_mysql mbstring xml bcmath gd zip intl opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# UID 1000 = WSL2 の risa ユーザーと一致させて bind mount の権限問題を防ぐ
RUN addgroup -g 1000 appgroup && adduser -u 1000 -G appgroup -s /bin/bash -D appuser

USER appuser

# appuser として laravel installer をインストールし PATH に追加
RUN composer global require laravel/installer
ENV PATH="/home/appuser/.composer/vendor/bin:${PATH}"

WORKDIR /var/www/html
