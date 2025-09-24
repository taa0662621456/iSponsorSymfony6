# Deploy Guide

## 🔑 Предварительные условия
- Настроен **сервер** с Docker и docker-compose.
- Добавлен SSH-ключ в GitHub Secrets:
  - `SSH_PRIVATE_KEY` — приватный ключ для подключения.
- Создан пользователь (например, `user`), у которого есть доступ к `/var/www/project`.

## ⚡ Автодеплой через GitHub Actions
Workflow: `.github/workflows/deploy.yml`

- Запускается при пуше в ветку `main`.
- Действия:
  1. Подключается к серверу по SSH.
  2. Копирует файлы через `rsync`.
  3. Выполняет `docker-compose pull && docker-compose up -d --build`.

## 🐳 Docker на сервере
Используются:
- `docker-compose.prod.yml` — конфигурация для продакшена (PHP-FPM + Nginx + Postgres).
- `docker/nginx/default.conf` — конфигурация Nginx.

Запуск вручную:

```bash
docker-compose -f docker-compose.prod.yml up -d --build
```

## 📦 Полезные команды на сервере
- Перезапустить сервисы:
```bash
docker-compose -f docker-compose.prod.yml restart
```

- Просмотреть логи:
```bash
docker-compose -f docker-compose.prod.yml logs -f
```

- Зайти в контейнер PHP:
```bash
docker exec -it project_app bash
```

## 🔐 Secrets для деплоя
- `SSH_PRIVATE_KEY` — приватный ключ (для GitHub Actions).
- `DATABASE_URL` — строка подключения к базе (Postgres).
- `APP_SECRET` — Symfony секрет.
- `JWT_PASSPHRASE` — если используется JWT.

---
✅ Теперь проект можно деплоить одной командой (`git push origin main`) — GitHub Actions всё сделает автоматически.
