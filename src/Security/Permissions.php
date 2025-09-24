<?php
namespace App\Security;

/**
 * Единый словарь всех прав доступа проекта.
 *
 * Формат: ENTITY_ACTION
 * ENTITY = сущность (ORDER, PRODUCT, PROJECT, VENDOR, USER, ADMIN, ...)
 * ACTION = CRUD-действие (VIEW, CREATE, EDIT, DELETE)
 *          или спец-действие (CANCEL, REFUND, PAY, PUBLISH, ARCHIVE, ...)
 */
final class Permissions
{
    // ==== ORDERS ====
    public const ORDER_VIEW   = 'ORDER_VIEW';
    public const ORDER_CREATE = 'ORDER_CREATE';
    public const ORDER_EDIT   = 'ORDER_EDIT';
    public const ORDER_DELETE = 'ORDER_DELETE';
    public const ORDER_CANCEL = 'ORDER_CANCEL';
    public const ORDER_REFUND = 'ORDER_REFUND';
    public const ORDER_PAY    = 'ORDER_PAY';

    // ==== PRODUCTS ====
    public const PRODUCT_VIEW      = 'PRODUCT_VIEW';
    public const PRODUCT_CREATE    = 'PRODUCT_CREATE';
    public const PRODUCT_EDIT      = 'PRODUCT_EDIT';
    public const PRODUCT_DELETE    = 'PRODUCT_DELETE';
    public const PRODUCT_PUBLISH   = 'PRODUCT_PUBLISH';
    public const PRODUCT_FAVOURITE = 'PRODUCT_FAVOURITE';

    // ==== VENDORS ====
    public const VENDOR_VIEW   = 'VENDOR_VIEW';
    public const VENDOR_CREATE = 'VENDOR_CREATE';
    public const VENDOR_EDIT   = 'VENDOR_EDIT';
    public const VENDOR_DELETE = 'VENDOR_DELETE';

    // ==== USERS ====
    public const USER_VIEW   = 'USER_VIEW';
    public const USER_CREATE = 'USER_CREATE';
    public const USER_EDIT   = 'USER_EDIT';
    public const USER_DELETE = 'USER_DELETE';

    // ==== PROJECTS ====
    public const PROJECT_VIEW    = 'PROJECT_VIEW';
    public const PROJECT_CREATE  = 'PROJECT_CREATE';
    public const PROJECT_EDIT    = 'PROJECT_EDIT';
    public const PROJECT_DELETE  = 'PROJECT_DELETE';
    public const PROJECT_PUBLISH = 'PROJECT_PUBLISH';
    public const PROJECT_ARCHIVE = 'PROJECT_ARCHIVE';

    // ==== ADMIN PANEL ====
    public const ADMIN_DASHBOARD = 'ADMIN_DASHBOARD';
    public const ADMIN_EXPORT    = 'ADMIN_EXPORT';
    public const ADMIN_SETTINGS  = 'ADMIN_SETTINGS';

    /**
     * Плоский список всех прав (для экспорта, тестов и т.д.)
     */
    public static function all(): array
    {
        $refl = new \ReflectionClass(__CLASS__);
        return array_values($refl->getConstants());
    }

    /**
     * Группированный список прав по модулям (для UI, матриц).
     */
    public static function grouped(): array
    {
        return [
            'Orders' => [
                self::ORDER_VIEW,
                self::ORDER_CREATE,
                self::ORDER_EDIT,
                self::ORDER_DELETE,
                self::ORDER_CANCEL,
                self::ORDER_REFUND,
                self::ORDER_PAY,
            ],
            'Products' => [
                self::PRODUCT_VIEW,
                self::PRODUCT_CREATE,
                self::PRODUCT_EDIT,
                self::PRODUCT_DELETE,
                self::PRODUCT_PUBLISH,
                self::PRODUCT_FAVOURITE,
            ],
            'Vendors' => [
                self::VENDOR_VIEW,
                self::VENDOR_CREATE,
                self::VENDOR_EDIT,
                self::VENDOR_DELETE,
            ],
            'Users' => [
                self::USER_VIEW,
                self::USER_CREATE,
                self::USER_EDIT,
                self::USER_DELETE,
            ],
            'Projects' => [
                self::PROJECT_VIEW,
                self::PROJECT_CREATE,
                self::PROJECT_EDIT,
                self::PROJECT_DELETE,
                self::PROJECT_PUBLISH,
                self::PROJECT_ARCHIVE,
            ],
            'Admin' => [
                self::ADMIN_DASHBOARD,
                self::ADMIN_EXPORT,
                self::ADMIN_SETTINGS,
            ],
        ];
    }
}
