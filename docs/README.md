# API Documentation & Tools

Этот каталог содержит все необходимые материалы для работы и тестирования API.

## Содержимое

- **openapi.yaml** — полная спецификация API (Swagger/OpenAPI 3.0)  
- **postman_collection.json** — Postman Collection с примерами запросов  
- **postman_environment.json** — Postman Environment с переменными `baseUrl` и `token`  
- **insomnia_workspace.yaml** — Insomnia workspace (авто-логин с JWT)  
- **insomnia_workspace_refresh_stub.yaml** — Insomnia workspace c заготовкой для refresh-токена

## Использование

### Swagger UI
```bash
docker run -p 8080:8080 -e SWAGGER_JSON=/openapi.yaml -v $(pwd)/openapi.yaml:/openapi.yaml swaggerapi/swagger-ui
```
Открой: [http://localhost:8080](http://localhost:8080)

### Postman
1. Импортируй `postman_collection.json`  
2. Импортируй `postman_environment.json`  
3. Включи окружение **E-Commerce API Env**  
4. Задай JWT токен в переменной `token` или выполни логин-запрос

### Insomnia
1. Импортируй `insomnia_workspace.yaml` (или `insomnia_workspace_refresh_stub.yaml`)  
2. Перейди в папку **Auth → Login**  
3. Введи правильные email/пароль и выполни запрос  
4. Токен автоматически сохранится в `{{ token }}`  
5. Все админские запросы будут использовать его в `Authorization: Bearer`

Если твой API поддерживает refresh-токен:
- Используй `insomnia_workspace_refresh_stub.yaml`
- Выполни `Auth → Refresh Token`, чтобы обновить `{{ token }}`

---

## Диаграмма API-потоков

```mermaid
sequenceDiagram
    participant C as Customer
    participant API as Public API
    participant A as Admin
    participant AdmAPI as Admin API

    C->>API: POST /api/orders (создание заказа)
    API-->>C: 201 Created (Order: NEW)

    A->>AdmAPI: PATCH /admin/api/orders/{id}/status (PENDING_PAYMENT)
    AdmAPI-->>A: 200 OK

    A->>AdmAPI: PATCH /admin/api/orders/{id}/status (PAID)
    AdmAPI-->>A: 200 OK

    C->>API: GET /api/orders/{id}
    API-->>C: 200 OK (Order: PAID)
```

## Диаграмма архитектуры слоёв

```mermaid
graph TD
    A[Entities] --> B[DTOs]
    B --> C[Public API Controllers]
    C --> D[SmartCrud / Admin Controllers]
    D --> E[Security Layer (Voter / IsGranted)]
    E --> F[Persistence (Doctrine / DB)]
```

## ER-диаграмма сущностей

```mermaid
erDiagram
    VENDOR ||--o{ ORDER : places
    ORDER ||--o{ ORDER_ITEM : contains
    PRODUCT ||--o{ ORDER_ITEM : "ordered as"

    VENDOR {
        int id
        string email
        string roles
    }
    ORDER {
        int id
        string status
        decimal grandTotal
        string currency
    }
    ORDER_ITEM {
        int id
        int qty
        decimal unitPrice
        decimal rowTotal
    }
    PRODUCT {
        int id
        string name
        string code
        string slug
    }
```

## Диаграмма ролей и прав доступа

```mermaid
graph LR
    Customer[Customer]
    Manager[Manager]
    Admin[Admin]

    Customer -->|Can| PublicAPI[Public API]
    Customer -.->|Forbidden| AdminAPI[Admin API]

    Manager -->|Can view & update limited| AdminAPI
    Admin -->|Full access| AdminAPI

    classDef role fill:#f9f,stroke:#333,stroke-width:2px;
    class Customer,Manager,Admin role;
```

## Жизненный цикл заказа (Order Lifecycle)

```mermaid
stateDiagram-v2
    [*] --> NEW
    NEW --> PENDING_PAYMENT: Customer places order
    PENDING_PAYMENT --> PAID: Payment successful
    PENDING_PAYMENT --> CANCELED: Payment failed / canceled
    PAID --> SHIPPED: Order dispatched
    SHIPPED --> COMPLETED: Delivered to customer
    PAID --> REFUNDED: Refund issued
    COMPLETED --> RETURNED: Customer returns order
    CANCELED --> [*]
    RETURNED --> [*]
```

## Диаграмма интеграций

```mermaid
graph TD
    Customer --> PublicAPI
    PublicAPI --> OrderService[Order Service]
    OrderService --> PaymentGateway[Payment Gateway]
    OrderService --> ShippingAPI[Shipping API]
    OrderService --> Notification[Notification Service]
    Admin --> AdminAPI
    AdminAPI --> OrderService
```

## Диаграмма деплоймента

```mermaid
graph TD
    subgraph Client Side
        CustomerApp[Customer Web/Mobile App]
        AdminPanel[Admin Panel]
    end

    subgraph Server Side
        APIServer[Symfony API Server]
        DB[(PostgreSQL DB)]
        Cache[(Redis Cache)]
    end

    subgraph External Services
        Pay[Payment Gateway]
        Ship[Shipping API]
        Notify[Notification Service]
    end

    CustomerApp --> APIServer
    AdminPanel --> APIServer

    APIServer --> DB
    APIServer --> Cache

    APIServer --> Pay
    APIServer --> Ship
    APIServer --> Notify
```

---

⚡ Рекомендация: держать эти файлы в каталоге `/docs` репозитория, чтобы команда могла ими пользоваться.
