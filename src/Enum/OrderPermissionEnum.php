<?php

namespace App\Enum;

enum OrderPermissionEnum: string
{
    case VIEW   = 'VIEW';
    case EDIT   = 'EDIT';
    case DELETE = 'DELETE';
    case CANCEL = 'CANCEL';
    case REFUND = 'REFUND';
    case PAY    = 'PAY';
}
