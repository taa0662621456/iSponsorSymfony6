<?php

namespace App\DTO\Order;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Entity\Order\OrderStatus;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiResource(mercure: true)]
final class OrderLogDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private OrderStatus $orderStatusCode;

    private bool $customerNotified = false;

    private ?string $comment = null;

    private ?string $oHash = null;

    public function getOrderStatusCode(): OrderStatus
    {
        return $this->orderStatusCode;
    }

    public function setOrderStatusCode($orderStatusCode): void
    {
        $this->orderStatusCode = $orderStatusCode;
    }

    public function isCustomerNotified(): bool
    {
        return $this->customerNotified;
    }

    public function setCustomerNotified(bool $customerNotified): void
    {
        $this->customerNotified = $customerNotified;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getOHash(): ?string
    {
        return $this->oHash;
    }

    public function setOHash(?string $oHash): void
    {
        $this->oHash = $oHash;
    }
}
