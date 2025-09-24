# Symfony Project

## 📖 Overview
Это Symfony-проект с поддержкой CI/CD, Docker и автодеплоя.  
Включает:
- Полный Docker-стек (dev, test, prod).
- PHPUnit + PHPStan тесты.
- CI/CD через GitHub Actions (lint, stan, test, coverage, migrations, deploy).
- Автодеплой на сервер через SSH и docker-compose.

---

## 🚀 Установка и запуск

### 1. Склонировать репозиторий
```bash
git clone https://github.com/your-username/your-project.git
cd your-project
```

### 2. Установить зависимости
```bash
composer install
```

### 3. Настроить окружение
```bash
cp .env.example .env
```

### 4. Запустить в Docker (dev)
```bash
docker-compose -f docker-compose.dev.yml up --build -d
```

---

## 🧪 Тестирование

Запуск тестов локально:
```bash
make test
```

Запуск тестов с покрытием:
```bash
make coverage
```

Запуск тестов в Docker:
```bash
docker-compose -f docker-compose.test.yml up --build --exit-code-from app
```

---

## ⚙️ CI/CD

Workflow в `.github/workflows/`:
- `ci.yml` — полный CI (lint + stan + test + coverage).
- `qa.yml` — быстрый QA на PR.
- `migrations.yml` — проверка Doctrine миграций.
- `full-ci.yml` — полный пайплайн (qa + migrations + tests).
- `nightly.yml` — ночной прогон.
- `release.yml` — релизы при git-теге.
- `deploy.yml` — автодеплой при push в main.

---

## 🐳 Docker окружения

- `docker-compose.dev.yml` — dev с hot reload.
- `docker-compose.test.yml` — тесты (phpunit + phpstan).
- `docker-compose.override.yml` — локальный Postgres + Adminer.
- `docker-compose.prod.yml` — прод (PHP-FPM + Nginx + Postgres).

---

## 🔑 Secrets

- `SSH_PRIVATE_KEY`
- `DATABASE_URL`
- `APP_SECRET`
- `JWT_PASSPHRASE`
- `DOCKER_HUB_USERNAME`
- `DOCKER_HUB_ACCESS_TOKEN`

---

## 📜 Документация

Подробные инструкции см. в:
- `README_docker.md` — Docker окружения
- `README_tests.md` — тестирование
- `README_ci.md` — CI/CD
- `README_deploy.md` — деплой
- `README_full.md` — полная документация

---
✅ Готово к использованию: разработка, тестирование, CI/CD и деплой.
