FROM dunglas/frankenphp:1-php8.4 AS base
WORKDIR /app
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

FROM base AS build
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist
COPY . .
RUN composer dump-autoload --optimize --classmap-authoritative \
 && APP_ENV=prod APP_DEBUG=0 php bin/console keel:compile \
 && APP_ENV=prod APP_DEBUG=0 php bin/console keel:preload

FROM base
ENV APP_ENV=prod APP_DEBUG=0 SERVER_NAME=:8080
COPY --from=build /app /app
COPY Caddyfile /etc/frankenphp/Caddyfile
RUN echo "opcache.preload=/app/var/cache/prod/preload.php" > /usr/local/etc/php/conf.d/preload.ini
EXPOSE 8080
