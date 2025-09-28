# Running Tests

Этот проект поддерживает тестирование как локально, так и в Docker.

## 🧪 Локальный запуск тестов

Убедитесь, что установлены зависимости:

```bash
composer install
```

Запуск юнит-тестов:

```bash
vendor/bin/phpunit -c phpunit.xml.dist
```

Запуск тестов с покрытием:

```bash
vendor/bin/phpunit -c phpunit.xml.dist --coverage-html build/coverage --coverage-text
```

Статический анализ:

```bash
vendor/bin/phpstan analyse src --level=max
```

## 🐳 Запуск тестов в Docker

Используйте `docker-compose.test.yml`:

```bash
docker-compose -f docker-compose.test.yml up --build --exit-code-from app
```

Этот контейнер выполнит:

- `vendor/bin/phpunit` (юнит-тесты)
- `vendor/bin/phpstan analyse src --level=max` (PHPStan)

База данных для тестов поднимается отдельно (`postgres:15`, порт 5434).

## 🔧 Полезные команды

- Проверить синтаксис PHP:
```bash
make lint
```

- Запустить полный цикл проверки (lint + stan + test):
```bash
make check
```

- Запустить QA (check + php-cs-fixer dry-run):
```bash
make qa
```

---
✅ Таким образом, можно быстро прогонять тесты как локально, так и в контейнере.
