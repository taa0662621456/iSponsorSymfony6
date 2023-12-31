# Используйте официальный образ Redis
FROM redis:latest

# Копируйте конфигурационный файл, если он у вас есть
# COPY redis.conf /usr/local/etc/redis/redis.conf

# Укажите настройки через CMD, если они не определены в конфигурационном файле
# CMD ["redis-server", "/usr/local/etc/redis/redis.conf"]

# Откройте стандартный порт Redis
EXPOSE 6379
