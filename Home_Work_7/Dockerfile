## Используйте официальный образ PHP с Apache в качестве базового образа
#FROM php:8.2-apache
#
#RUN apt-get update && \
#    apt-get install -y \
#    libzip-dev \
#    zip \
#    mc \
#    unzip \
#    && docker-php-ext-install zip
#
## Включите модули Apache
#RUN a2enmod rewrite
#
## Установите рабочую директорию внутри контейнера
#WORKDIR /var/www/html
#
## Скопируйте содержимое локального проекта Laravel в контейнер
#COPY ./homework /var/www/html
#
### Устанавливаем Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
##
### Устанавливаем зависимости Laravel
#RUN composer install --optimize-autoloader --no-dev
#
## Установите разрешения для того, чтобы Apache мог записывать в директории storage и bootstrap
#RUN chown -R www-data:www-data storage bootstrap
#
## Откройте порт 80 для Apache
#EXPOSE 80
#
## Запустите Apache в фоновом режиме
#CMD ["apache2-foreground"]


# Используем образ с Apache и PHP для Laravel
FROM php:8.2-apache

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

# Опционально: Копируем файл конфигурации Apache
COPY apache-config/httpd.conf /etc/apache2/sites-available/000-default.conf

# Опционально: Устанавливаем необходимые настройки Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Опционально: Копируем кастомные настройки Apache
COPY apache-config/httpd.conf /etc/apache2/sites-available/000-default.conf

# Запускаем Apache
CMD ["apache2-foreground"]
