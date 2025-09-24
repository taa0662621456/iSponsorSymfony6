<?php

namespace App\Security;

use App\Enum\OrderPermissionEnum;

final class OrderPermissionEnumMatrix
{

    public const MATRIX = [
        'ROLE_ADMIN' => [
            OrderPermissionEnum::VIEW,
            OrderPermissionEnum::EDIT,
            OrderPermissionEnum::DELETE,
            OrderPermissionEnum::CANCEL,
            OrderPermissionEnum::REFUND,
            OrderPermissionEnum::PAY,
        ],
        'ROLE_MANAGER' => [
            OrderPermissionEnum::VIEW,
            OrderPermissionEnum::EDIT,
            OrderPermissionEnum::DELETE,
            OrderPermissionEnum::CANCEL,
            OrderPermissionEnum::REFUND,
        ],
        'ROLE_VENDOR' => [
            OrderPermissionEnum::VIEW,
            OrderPermissionEnum::EDIT,
            OrderPermissionEnum::DELETE,
            OrderPermissionEnum::CANCEL,
            OrderPermissionEnum::REFUND,
        ],
        'ROLE_CUSTOMER' => [
            OrderPermissionEnum::VIEW,
            OrderPermissionEnum::EDIT,
            OrderPermissionEnum::CANCEL,
            OrderPermissionEnum::PAY,
        ],
    ];
}
