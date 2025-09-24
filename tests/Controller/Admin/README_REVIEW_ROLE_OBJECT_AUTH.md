# Admin Review/Role/Object/Auth Tests with Fixtures

Функциональные и unit тесты для блоков Review/Role/Object/Auth.

### Review
- ReviewProjectCrudControllerTest (approve/reject)
- ReviewProductCrudControllerTest (approve/reject)
- ReviewTraitTest (unit)

### Role
- RoleCrudControllerTest (assign/remove)

### Object
- ObjectTraitTest (unit)
- IdempotencyKeyEntityCrudControllerTest (generate/invalidate)

### Auth
- OAuthTraitTest (unit)
- TotpAuthenticationTraitTest (unit)
- AkismetTraitTest (unit)
