# Используйте официальный образ PostgreSQL как базовый
FROM postgres:13

# Установите дополнительные инструменты или расширения, если это необходимо
# RUN apt-get update && apt-get install -y your-additional-tools

# Копируйте конфигурационные файлы или скрипты инициализации, если они у вас есть
#COPY ./your-custom-config.conf /etc/postgresql/
#COPY ./init-database.sh /docker-entrypoint-initdb.d/

# Опционально: установите переменные окружения, если они нужны
# ENV POSTGRES_DB=yourdbname
# ENV POSTGRES_USER=yourusername
# ENV POSTGRES_PASSWORD=yourpassword

# Откройте порт, используемый PostgreSQL
EXPOSE 5432

# Команда запуска PostgreSQL уже определена в базовом образе,
# поэтому переопределять CMD не обязательно, если вы не хотите изменять стандартное поведение
