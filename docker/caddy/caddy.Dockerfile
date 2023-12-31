FROM caddy:2-alpine

# COPY Caddyfile /etc/caddy/Caddyfile

# Копирование статических файлов (если есть)
# COPY /path/to/your/site /srv

# Указание рабочей директории
WORKDIR /srv

# Открытие порта 80 и 443
EXPOSE 80
EXPOSE 443

# Запуск Caddy
CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]
