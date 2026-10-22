FROM php:8.3-apache

RUN apt-get update && apt-get install -y libpq-dev zip unzip curl \
    && docker-php-ext-install pdo pdo_pgsql

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .
RUN composer install --optimize-autoloader --no-dev
RUN npm install && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

EXPOSE 80
