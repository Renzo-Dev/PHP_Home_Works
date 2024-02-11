# Используем образ с Apache и PHP для Laravel
FROM php:8.3.2-apache

# Устанавливаем необходимые расширения PHP
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    mc \
    unzip \
    && docker-php-ext-install zip

# Копируем файлы Laravel в контейнер
COPY ./homework /var/www/html/

# Устанавливаем права на директорию storage и bootstrap
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем зависимости Laravel
RUN cd /var/www/html/ && composer install --no-interaction --no-dev --optimize-autoloader

# Активируем модуль rewrite для Apache
RUN a2enmod rewrite

# Опционально: Устанавливаем необходимые настройки Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Запускаем Apache
CMD ["apache2-foreground"]
