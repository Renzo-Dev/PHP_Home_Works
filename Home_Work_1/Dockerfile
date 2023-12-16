# Используем базовый образ с Apache
FROM php:8.2-apache

#RUN apt-get update \
#    && apt-get upgrade -y \
#    && apt install mc

RUN apt-get update && apt-get upgrade -y && apt-get -y install mc

# Копируем конфигурационные файлы Apache в контейнер
COPY ./apache-config/ /usr/local/apache2/conf/

# Копируем содержимое текущей директории в /usr/local/apache2/htdocs/ в контейнере
COPY ./html/ /usr/local/apache2/htdocs/

RUN chown -R $(whoami):$(id -gn) /var/www/html