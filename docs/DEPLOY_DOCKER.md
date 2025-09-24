# Docker Setup Guide

Этот проект поддерживает окружения для **разработки**, **тестирования** и **продакшена** через Docker Compose.

## 🚀 Dev окружение
Используется `docker-compose.dev.yml`:

```bash
docker-compose -f docker-compose.dev.yml up --build -d
```

Сервисы:
- `app` — PHP-FPM (Symfony, hot reload через volume)
- `web` — Nginx (http://localhost:8081)
- `database` — PostgreSQL (порт 5433)
- `adminer` — UI для БД (http://localhost:8080)

## 🧪 Test окружение
Можно использовать `docker-compose.override.yml` для локального тестирования с Postgres и Adminer:

```bash
docker-compose -f docker-compose.override.yml up -d
```

Сервисы:
- `database` — PostgreSQL (порт 5432)
- `adminer` — http://localhost:8080

## 🏢 Prod окружение
Используется `docker-compose.prod.yml`:

```bash
docker-compose -f docker-compose.prod.yml up --build -d
```

Сервисы:
- `app` — PHP-FPM (Symfony, APP_ENV=prod)
- `web` — Nginx (http://localhost)
- `database` — PostgreSQL (порт 5432)

Nginx конфигурация: `docker/nginx/default.conf`.

## 🔧 Полезные команды
- Пересобрать контейнеры:

```bash
docker-compose -f docker-compose.dev.yml build --no-cache
```

- Просмотреть логи:

```bash
docker-compose -f docker-compose.dev.yml logs -f
```

- Зайти в контейнер PHP:

```bash
docker exec -it project_app bash
```

---
✅ Теперь можно разворачивать окружение в 1 команду.
