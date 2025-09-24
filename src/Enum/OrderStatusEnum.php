<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case DRAFT = 'draft';
    case CONFIRMED = 'confirmed';
    case PAID = 'paid';
    case SHIPPED = 'shipped';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
    case PENDING_PAYMENT = 'pending_payment';
    case FULFILLING = 'fulfilling';
    case PARTIALLY_SHIPPED = 'partially_shipped';
    case CANCELED = 'canceled';
}
