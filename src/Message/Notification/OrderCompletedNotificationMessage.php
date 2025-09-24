<?php
namespace App\Message\Notification;

final class OrderCompletedNotificationMessage
{
    public function __construct(
        private readonly int $orderId
    ) {}

    public function getOrderId(): int
    {
        return $this->orderId;
    }
}
