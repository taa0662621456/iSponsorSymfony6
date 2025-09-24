# Full Project Documentation

Этот файл объединяет все инструкции по работе с проектом: Docker, тесты, CI/CD, деплой.

---

## 🐳 Docker окружения

### Dev
```bash
docker-compose -f docker-compose.dev.yml up --build -d
```
Сервисы:
- `app` (PHP-FPM, hot reload)
- `web` (Nginx http://localhost:8081)
- `database` (Postgres 5433)
- `adminer` (http://localhost:8080)

### Test
```bash
docker-compose -f docker-compose.test.yml up --build --exit-code-from app
```
Выполняет PHPUnit и PHPStan внутри контейнера.

### Prod
```bash
docker-compose -f docker-compose.prod.yml up --build -d
```
Сервисы:
- `app` (PHP-FPM, Symfony)
- `web` (Nginx, http://localhost)
- `database` (Postgres 5432)

Nginx конфигурация: `docker/nginx/default.conf`

---

## 🧪 Тестирование

Локально:
```bash
vendor/bin/phpunit -c phpunit.xml.dist
vendor/bin/phpstan analyse src --level=max
```

В Docker:
```bash
docker-compose -f docker-compose.test.yml up --build --exit-code-from app
```

---

## ⚙️ CI/CD

### Workflow
- `ci.yml` — полный CI при push/PR (`make ci`).
- `qa.yml` — быстрый QA при PR (`make qa`).
- `migrations.yml` — проверка и прогон миграций.
- `full-ci.yml` — объединённый пайплайн (qa + migrations + tests).
- `nightly.yml` — ночной прогон раз в сутки.
- `release.yml` — релиз при git-теге (`v*.*.*`).
- `deploy.yml` — автодеплой при push в main.

### Makefile Targets
- `make test` — PHPUnit
- `make test-parallel` — Paratest
- `make coverage` — Code coverage
- `make stan` — PHPStan
- `make fixtures` — загрузка фикстур
- `make migrate` — миграции Doctrine
- `make cs-fix` — PHP-CS-Fixer
- `make lint` — php -l
- `make check` — lint + stan + test
- `make qa` — check + cs-fix dry-run
- `make ci` — qa + coverage

---

## 🚀 Deploy

Автодеплой через GitHub Actions (`deploy.yml`):
- При пуше в main файлы копируются на сервер через rsync.
- Выполняется `docker-compose up -d --build`.

Ручной запуск:
```bash
docker-compose -f docker-compose.prod.yml up -d --build
```

Полезные команды:
```bash
docker-compose -f docker-compose.prod.yml restart
docker-compose -f docker-compose.prod.yml logs -f
docker exec -it project_app bash
```

---

## 🔑 Secrets

Необходимые secrets для GitHub Actions:
- `SSH_PRIVATE_KEY`
- `DATABASE_URL`
- `APP_SECRET`
- `JWT_PASSPHRASE`
- `DOCKER_HUB_USERNAME`, `DOCKER_HUB_ACCESS_TOKEN`

---
✅ В этом документе собраны все инструкции: Docker, тесты, CI/CD и деплой.
