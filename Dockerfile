FROM alpine as waitfor-builder

RUN apk add --no-cache wget && \
    wget -q -O /wait-for https://raw.githubusercontent.com/eficode/wait-for/v2.2.3/wait-for && \
    chmod +x /wait-for

FROM composer:latest as app-builder

WORKDIR /app

COPY composer.json ./

RUN composer install --no-dev --no-scripts --no-autoloader --optimize-autoloader --prefer-dist

COPY . .

RUN composer dump-autoload --optimize

FROM php:8.1-fpm-alpine

# Instalar extensões necessárias para o PostgreSQL
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY --from=app-builder /app .

COPY --from=waitfor-builder /wait-for /usr/bin/wait-for

COPY start.sh /start.sh

RUN chmod +x /start.sh