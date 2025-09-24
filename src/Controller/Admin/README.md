# Admin Controllers Refactor — Full

Covers all admin controllers with business actions and guard rules.

## Highlights
- **Vendor**: approve/suspend/export + media & docs validation
- **Product**: price validation, mark featured, export
- **Project**: publish/unpublish/feature + requires reward & tags
- **Reviews**: approve/reject/spam
- **Tags & Attachments**: bulk add/remove, validate
- **Prices & Rewards**: validate, recalc
- **Dashboard**: services-based stats & notifications
- **Security**: login form controller

All controllers inherit from `BaseCrudController` and may use `ConfigureCrudDefaultsTrait` for fields/filters.

> Note: action methods use flash messages and redirect back; replace stubs with real services as needed.
