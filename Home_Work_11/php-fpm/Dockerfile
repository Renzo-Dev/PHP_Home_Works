FROM php:8.1-fpm

# Установка необходимых пакетов для PHP-FPM и Nginx
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y git \
            libzip-dev \
            zip \
            mc \
            unzip \
            --no-install-recommends \
            curl \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libonig-dev; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    # Install the PHP pdo_mysql extention
#    docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());'

RUN mkdir -p /var/run/php/

RUN chmod 755 /var/run/php/

RUN cd /var/www/html/

# Копируем файлы Laravel в контейнер
#COPY ../laravel /var/www/html/

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN composer create-project laravel/laravel .

# Устанавливаем права на директорию storage и bootstrap
RUN #chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap

# Устанавливаем зависимости Laravel
RUN #composer install --no-interaction --no-dev --optimize-autoloader

RUN #./artisan key:generate

# Открываем порт 9000, который используется PHP-FPM
EXPOSE 9000

# Запускаем PHP-FPM при старте контейнера
CMD ["php-fpm"]


#DB_CONNECTION=pgsql
#DB_HOST=db
#DB_PORT=5432
#DB_DATABASE=homeWork
#DB_USERNAME=Renzo
#DB_PASSWORD=12345