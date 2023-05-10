<?php

namespace App\DTO\Payment;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

/**
 * @method array getDetails()
 */
final class PaymentDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    public function getCreditCard(): void
    {
        // TODO: Implement getCreditCard() method.
    }

    /**
     * @param object $details
     */
    public function setDetails($details): void
    {
        // TODO: Implement setDetails() method.
    }

    public function getNumber(): string
    {
        // TODO: Implement getNumber() method.
        return '';
    }

    public function getDescription(): string
    {
        // TODO: Implement getDescription() method.
        return '';
    }

    public function getClientEmail(): string
    {
        // TODO: Implement getClientEmail() method.
        return '';
    }

    public function getClientId(): void
    {
        // TODO: Implement getClientId() method.
    }

    public function getTotalAmount(): int
    {
        // TODO: Implement getTotalAmount() method.
        return 1;
    }

    public function getCurrencyCode(): string
    {
        // TODO: Implement getCurrencyCode() method.
        return '';
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method array getDetails()
    }
}
