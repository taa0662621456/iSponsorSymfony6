<?php

namespace App\Entity\Payment;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Payment\PaymentInterface;
use App\Repository\Payment\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @method array getDetails()
 */
#[ORM\Table(name: 'payment')]
#[ORM\Index(columns: ['slug'], name: 'payment_idx')]
#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class Payment extends ObjectSuperEntity implements ObjectInterface, PaymentInterface
{

    /**
     * @return void
     */
    public function getCreditCard(): void
    {
        // TODO: Implement getCreditCard() method.
    }

    /**
     * @param object $details
     *
     * @return void
     */
    public function setDetails(object $details): void
    {
        // TODO: Implement setDetails() method.
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        // TODO: Implement getNumber() method.
        return '';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        // TODO: Implement getDescription() method.
        return '';
    }

    /**
     * @return string
     */
    public function getClientEmail(): string
    {
        // TODO: Implement getClientEmail() method.
        return '';
    }

    /**
     * @return void
     */
    public function getClientId(): void
    {
        // TODO: Implement getClientId() method.
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        // TODO: Implement getTotalAmount() method.
        return 1;
    }

    /**
     * @return string
     */
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
