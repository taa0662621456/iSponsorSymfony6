<?php

namespace App\Entity\Commission;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Commission\CommissionInterface;

#[ORM\Entity]
final class Commission extends ObjectSuperEntity implements ObjectInterface, CommissionInterface
{
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
