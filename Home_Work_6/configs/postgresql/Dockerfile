# Используем официальный образ PostgreSQL
FROM postgres

# Устанавливаем переменные окружения
ENV POSTGRES_USER ${POSTGRES_USER}
ENV POSTGRES_PASSWORD ${POSTGRES_PASSWORD}
ENV POSTGRES_DB ${POSTGRES_DB}
# Копируем скрипт инициализации (если есть)
# COPY ./path/to/init-script.sql /docker-entrypoint-initdb.d/

# Копируем файл настроек PostgreSQL
COPY postgresql.conf /etc/postgresql/postgresql.conf