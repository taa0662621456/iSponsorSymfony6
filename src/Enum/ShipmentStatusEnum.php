<?php

namespace App\Enum;

enum ShipmentStatusEnum: string {
    case Pending = 'pending';
    case Shipped = 'shipped';
    case Delivered = 'delivered';
    case Returned = 'returned';
}
