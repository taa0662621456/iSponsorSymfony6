<?php

namespace App\Enum;

enum PaymentStatusEnum: string {
    case Pending = 'pending';
    case Paid = 'paid';
    case Failed = 'failed';
    case Refunded = 'refunded';
}