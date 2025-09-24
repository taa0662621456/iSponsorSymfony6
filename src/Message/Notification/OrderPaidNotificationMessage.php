<?php
namespace App\Message\Notification;

final class OrderPaidNotificationMessage
{
    public function __construct(
        private readonly int $orderId
    ) {}

    public function getOrderId(): int
    {
        return $this->orderId;
    }
}
