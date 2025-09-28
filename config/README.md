# Symfony Config Split

Этот архив содержит разнесённые конфигурационные файлы Symfony для проекта.

## Структура

```
config/
 ├─ services.yaml
 └─ packages/
     ├─ parameters.yaml              # Базовые параметры проекта (имя, домен, локали, директории)
     ├─ security_parameters.yaml     # Секреты, токены, recaptcha, GPT, akismet
     ├─ mailer_parameters.yaml       # Настройки отправки почты (e-mail, smtp)
     ├─ cache_parameters.yaml        # Параметры Redis, Memcache, Memcached
     ├─ seo_parameters.yaml          # SEO мета-теги (MetaDesc, MetaKeys, robots и пр.)
     ├─ legacy_parameters.yaml       # Устаревшие/джумла-подобные настройки (offline, sef, debug и пр.)
     ├─ services_order.yaml          # Пайплайн обработки заказов и процессоры
     ├─ services_listeners.yaml      # Doctrine и Kernel listeners/subscribers
     ├─ services_security.yaml       # Two-Factor, OAuth, RateLimiters
     ├─ services_mailer.yaml         # Кастомные mailer-сервисы (например, NotificationService)
     └─ services_cache.yaml          # Redis сервисы, session handler
```

## Использование

- Основной файл: **config/services.yaml** импортирует все остальные куски через `imports:`.
- Настройки, чувствительные к окружению (SMTP user/pass, секреты) выносятся в `.env.local`.
- Новые сервисы добавляйте в соответствующие файлы по зонам ответственности.

## Преимущества

- Чистая структура, легко искать и редактировать конфиги.
- Параметры отделены от сервисов.
- Масштабируемо для больших проектов.
