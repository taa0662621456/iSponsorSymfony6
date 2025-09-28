# CI/CD Workflows Guide

Этот проект включает набор GitHub Actions workflow для автоматизации CI/CD процессов.

## ⚙️ Workflow Overview

### 1. `ci.yml`
- Запускается при каждом push и pull request.
- Поднимает PostgreSQL + PHP 8.3.
- Выполняет `make ci` (lint + stan + test + coverage).

### 2. `qa.yml`
- Запускается только на pull request.
- Выполняет быстрые проверки качества: `make qa` (lint + stan + test + cs-fixer dry-run).

### 3. `migrations.yml`
- Запускается на pull request.
- Поднимает PostgreSQL.
- Проверяет Doctrine схему, генерирует и прогоняет миграции.

### 4. `full-ci.yml`
- Запускается на push и pull request.
- Включает 3 job'а: `qa`, `migrations`, `tests`.
- Полный пайплайн (аналог CI/CD).

### 5. `nightly.yml`
- Запускается по расписанию (cron) каждый день в 02:00 UTC.
- Выполняет `make ci` для проверки стабильности кода.

### 6. `release.yml`
- Запускается при пуше git-тега (`v*.*.*`).
- Ставит зависимости (без dev).
- Прогоняет миграции.
- Создаёт GitHub Release с release notes.

### 7. `deploy.yml`
- Запускается при пуше в ветку `main`.
- Подключается по SSH (ключ из `SSH_PRIVATE_KEY`).
- Копирует файлы через `rsync`.
- Выполняет `docker-compose up -d --build` для перезапуска на сервере.

## 🔑 Требуемые Secrets

- `SSH_PRIVATE_KEY` — приватный ключ для деплоя.
- `DATABASE_URL` — строка подключения к PostgreSQL.
- `APP_SECRET` — секрет Symfony.
- `JWT_PASSPHRASE` — если используется JWT аутентификация.
- `DOCKER_HUB_USERNAME`, `DOCKER_HUB_ACCESS_TOKEN` — если используется Docker Hub.

## 📦 Makefile Targets

Workflow вызывают команды из Makefile:

- `make test` — PHPUnit.
- `make test-parallel` — Paratest.
- `make coverage` — покрытие кода.
- `make stan` — PHPStan.
- `make fixtures` — загрузка фикстур.
- `make migrate` — генерация и применение миграций.
- `make cs-fix` — автоформатирование.
- `make lint` — проверка синтаксиса PHP.
- `make check` — полный CI (lint + stan + test).
- `make qa` — check + php-cs-fixer dry-run.
- `make ci` — qa + coverage.

---
✅ Таким образом, проект имеет полный CI/CD pipeline с поддержкой QA, миграций, релизов и деплоя.
