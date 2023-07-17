FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY . /var/www/html/

EXPOSE 8080

CMD php -S 0.0.0.0:8080 -t /var/www/html/
