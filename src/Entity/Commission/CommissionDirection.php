<?php

namespace App\Entity\Commission;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Commission\CommissionInterface;

#[ORM\Entity]
final class CommissionDirection extends ObjectSuperEntity implements ObjectInterface, CommissionInterface
{
    #[ORM\Column(type: 'boolean')]
    public $toShipment;

    #[ORM\Column(type: 'boolean')]
    public $toPayment;

    #[ORM\Column(type: 'boolean')]
    public $toPrice;

    #[ORM\Column(type: 'boolean')]
    public $toDate;

    #[ORM\Column(type: 'boolean')]
    public $toPlatformReward;

    #[ORM\Column(type: 'boolean')]
    public $toStorage;

    #[ORM\Column(type: 'boolean')]
    public $toProjectType;

    #[ORM\Column(type: 'boolean')]
    public $toOrderTotal;

    #[ORM\Column(type: 'boolean')]
    public $toProductCategory;

    public function isToShipment(): bool
    {
        return $this->toShipment;
    }

    public function setToShipment(bool $toShipment): void
    {
        $this->toShipment = $toShipment;
    }

    public function isToPayment(): bool
    {
        return $this->toPayment;
    }

    public function setToPayment(bool $toPayment): void
    {
        $this->toPayment = $toPayment;
    }

    public function isToPrice(): bool
    {
        return $this->toPrice;
    }

    public function setToPrice(bool $toPrice): void
    {
        $this->toPrice = $toPrice;
    }

    public function isToDate(): bool
    {
        return $this->toDate;
    }

    public function setToDate(bool $toDate): void
    {
        $this->toDate = $toDate;
    }

    public function isToPlatformReward(): bool
    {
        return $this->toPlatformReward;
    }

    public function setToPlatformReward(bool $toPlatformReward): void
    {
        $this->toPlatformReward = $toPlatformReward;
    }

    public function isToStorage(): bool
    {
        return $this->toStorage;
    }

    public function setToStorage(bool $toStorage): void
    {
        $this->toStorage = $toStorage;
    }

    public function isToProjectType(): bool
    {
        return $this->toProjectType;
    }

    public function setToProjectType(bool $toProjectType): void
    {
        $this->toProjectType = $toProjectType;
    }

    public function isToOrderTotal(): bool
    {
        return $this->toOrderTotal;
    }

    public function setToOrderTotal(bool $toOrderTotal): void
    {
        $this->toOrderTotal = $toOrderTotal;
    }

    public function isToProductCategory(): bool
    {
        return $this->toProductCategory;
    }

    // TODO: комиссии, налагаемые на способы доставки, оплаты и пр.
    /*
     * incrementCommission
     * decrementCommission
     * additionCommission
     * multiplicationCommission
     * subtractionCommission
     *
     * percentCommission
     * fixedCommission
     *
     * toShipment
     * toPayment
     * toPrice
     * toDate
     * toPlatformReward
     * toStorage
     * toProjectType
     * toOrderTotal
     * toProductCategory
     *
     *
     */
}
