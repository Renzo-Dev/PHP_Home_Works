# Используем официальный образ PHP
FROM php:7.4-fpm

# Устанавливаем необходимые расширения
RUN docker-php-ext-install pdo pdo_mysql

# Копируем конфигурацию PHP
COPY ./php.ini /usr/local/etc/php/php.ini

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем Laravel Installer
RUN composer global require laravel/installer

# Добавляем глобальные бинарные файлы в $PATH
ENV PATH="~/.composer/vendor/bin:${PATH}"

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем все файлы проекта
COPY . /var/www/html

# Устанавливаем зависимости Laravel
RUN composer install

# Устанавливаем права на запись для хранилища сессий и кэша
RUN chown -R www-data:www-data /var/www/html/storage

# Открываем порт для PHP-FPM
EXPOSE 9000

# Запускаем PHP-FPM
CMD ["php-fpm"]
