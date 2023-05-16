<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Payment\PaymentInterface;

/**
 * @method array getDetails()
 */
#[ORM\Entity]
final class Payment extends ObjectSuperEntity implements ObjectInterface, PaymentInterface
{
    public function getCreditCard(): void
    {
        // TODO: Implement getCreditCard() method.
    }

    public function setDetails(object $details): void
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
