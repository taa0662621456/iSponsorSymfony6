# Project Structure

Структура директорий и файлов проекта.

```
├── src/                     # Исходный код приложения (Symfony)
│   ├── Controller/          # Контроллеры
│   ├── Entity/              # Doctrine сущности
│   ├── Repository/          # Репозитории Doctrine
│   ├── Service/             # Сервисы приложения
│   └── ...
│
├── tests/                   # Тесты (PHPUnit)
│   ├── Entity/              # Тесты сущностей
│   ├── Controller/          # Тесты контроллеров
│   └── ...
│
├── docker/                  # Docker конфиги
│   ├── nginx/
│   │   └── default.conf     # Nginx конфигурация
│   └── ...
│
├── .github/
│   └── workflows/           # GitHub Actions workflow
│       ├── ci.yml
│       ├── qa.yml
│       ├── migrations.yml
│       ├── full-ci.yml
│       ├── nightly.yml
│       ├── release.yml
│       └── deploy.yml
│
├── migrations/              # Doctrine миграции
├── fixtures/                # Doctrine фикстуры
├── public/                  # Public директория (Symfony entry point index.php)
├── var/                     # Symfony кеш и логи
├── vendor/                  # Composer зависимости
│
├── .env.example             # Пример настроек окружения
├── docker-compose.dev.yml   # Docker для разработки
├── docker-compose.test.yml  # Docker для тестов
├── docker-compose.override.yml # Локальная БД и Adminer
├── docker-compose.prod.yml  # Docker для продакшена
├── Dockerfile               # PHP-FPM контейнер
├── Makefile                 # Утилитные команды
├── phpunit.xml.dist         # Конфигурация PHPUnit
├── phpunit_parallel.xml.dist# Конфигурация для Paratest
├── README.md                # Основное описание проекта
├── README_full.md           # Полная документация
├── README_docker.md         # Docker окружения
├── README_tests.md          # Тестирование
├── README_ci.md             # CI/CD
├── README_deploy.md         # Деплой
├── CONTRIBUTING.md          # Правила для контрибьюторов
├── SECURITY.md              # Политика безопасности
├── LICENSE                  # Лицензия (MIT)
└── CODEOWNERS               # Ответственные за review
```

---
✅ Эта структура поможет быстрее ориентироваться в проекте и понимать, где находятся основные части.
