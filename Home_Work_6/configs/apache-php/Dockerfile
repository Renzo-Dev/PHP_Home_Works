# Используем официальный образ PHP с Apache
FROM php:apache

RUN apt-get update && apt-get upgrade -y && apt-get -y install mc \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Копируем файлы веб-приложения в каталог /var/www/html
COPY httpd.conf /usr/local/apache2/conf/


# Опционально устанавливаем дополнительные зависимости PHP, например, для подключения к PostgreSQL
# RUN docker-php-ext-install pdo pdo_pgsql

# Опционально устанавливаем другие необходимые пакеты и зависимости
# RUN apt-get update && apt-get install -y some-package

# Устанавливаем рабочую директорию
WORKDIR /var/www/html