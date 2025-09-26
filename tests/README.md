# Test Suite Overview

This package contains a complete set of **business scenario tests** for both Symfony controllers and API endpoints.  
The tests rely on fixtures (grouped by entities like Product, Vendor, Project, Order, etc.) and cover real-world flows, not just smoke checks.

---

## 📂 Structure

### Controller Tests
- **HomepageControllerTest** – Ensures homepage loads and featured products are displayed.
- **SearchControllerTest** – Verifies search returns results for products.
- **CouponControllerTest** – Applies a coupon during checkout and verifies discount.
- **CurrencySwitchControllerTest** – Switches currency and checks recalculated prices.
- **LocaleSwitchControllerTest** – Switches locale (language) and verifies HTML lang attribute.
- **DashboardControllerTest** – Ensures dashboard is accessible only for logged-in users.
- **ExceptionControllerTest** – Checks correct templates for 404 and 500 pages.
- **FeaturedControllerTest** – Ensures featured products are listed.
- **LikeAjaxControllerTest** – Simulates AJAX like and verifies JSON response.
- **ObjectCRUDsControllerTest** – Tests entity creation via the generic CRUD controller.
- **PayumControllerTest** – Simulates redirect to payment provider and callback handling.
- **ResourceControllerTest** – Fetches resources (e.g., images, documents).
- **SetErrorControllerTest** – Stores error messages in session and displays them.

### API Tests
- **ProductApiTest** – Full CRUD for products, including vendor and category relations.
- **OrderApiTest** – Full order flow: create → pay → ship → final status check.
- **PaymentApiTest** – Creates payments and validates amounts.
- **ShipmentApiTest** – Creates shipments and verifies status updates.
- **CouponApiTest** – CRUD operations for coupons.
- **PromotionApiTest** – Applies promotions and ensures discounts are reflected in totals.
- **ProjectApiTest** – Creates projects with tags, types, and rewards.
- **VendorApiTest** – Creates vendors with profile and IBAN data.
- **CategoryApiTest** – Builds category hierarchy and verifies relations.
- **LocaleApiTest** – Lists available locales.
- **EventApiTest** – Creates events with categories and participants.
- **MenuApiTest** – Ensures menu items are linked to modules.

---

## ✅ Business Scenarios Covered
- Browsing catalog and searching products
- Creating orders with items and verifying totals
- Applying coupons and promotions
- Processing payments and marking orders as paid
- Adding shipments and verifying shipping status
- Creating and managing projects with rewards
- Vendor lifecycle: profile, products, documents
- Localization (currencies, languages)
- Events and menu modules

---

## 🚀 How to Run
1. Ensure your database is migrated and fixtures are enabled.
2. Run PHPUnit tests:
   ```bash
   php bin/phpunit --testdox
   ```
3. Optionally run specific groups (e.g., product, order):
   ```bash
   php bin/phpunit tests/Api/ProductApiTest.php
   ```

---

This test suite provides **end-to-end coverage** for controllers and APIs, simulating real business flows of the platform.
