# README — New Business Commands

## 📦 Vendor
- **`app:vendor:activate <id>`** — активирует вендора после модерации  
- **`app:vendor:suspend <id>`** — временно блокирует вендора  
- **`app:vendor:import-pricelist <vendorId> <file>`** — импорт прайс-листа (CSV/Excel)  
- **`app:vendor:stats <vendorId>`** — выводит статистику по продажам  

## 👥 User
- **`app:user:reset-password <email>`** — сброс пароля  
- **`app:user:assign-vendor <email> <vendorId>`** — закрепление менеджера за вендором  
- **`app:user:assign-role <email> <role>`** — назначение роли пользователю  

## 🛒 Business
- **`app:order:ship <orderId>`** — отметить заказ как отгруженный  
- **`app:order:refund <orderId>`** — оформить возврат  
- **`app:invoice:generate <orderId>`** — сгенерировать инвойс  
- **`app:payment:retry <paymentId>`** — повторить оплату  

## 📈 Marketing
- **`app:promotion:apply <promotionId>`** — активировать промо-акцию  
- **`app:promotion:expire <promotionId>`** — завершить промо-акцию  
- **`app:coupon:bulk-generate [--count=N] [--prefix=STR]`** — массовая генерация купонов  
- **`app:report:sales [--period=monthly|daily] [--output=csv]`** — отчёт по продажам  

## 🔧 System
- **`app:system:cleanup [--days=N]`** — чистка старых данных (по умолчанию 30 дней)  
- **`app:system:healthcheck`** — проверка состояния системы  
- **`app:system:metrics:export`** — экспорт метрик (Prometheus)  

---

### 🔑 Советы
- Добавить поддержку флагов `--json`, `--output=file.log`, `--dry-run`  
- Все действия логировать через Monolog (канал `command`)  
- Метрики экспортировать в Prometheus  
