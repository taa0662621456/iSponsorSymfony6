# Admin Security/Storage/Shipment/Address Tests with Fixtures

Функциональные тесты (WebTestCase) для админских контроллеров с in-memory фикстурами.

### Security
- SecurityApiTokenCrudControllerTest (revoke/refresh)
- SecuritySmsCodeCrudControllerTest (send/verify)
- SecurityPasswordRequestCrudControllerTest (reset password)
- VendorSecurityCrudControllerTest (enable/disable MFA)

### Storage
- StorageCrudControllerTest (add/remove file)

### Shipment
- ShipmentCrudControllerTest (mark shipped/cancel)
- ShipmentMethodCrudControllerTest (enable/disable)
- VendorShipmentCrudControllerTest (attach/detach shipment)

### Address
- AddressCrudControllerTest (add/update/delete)
