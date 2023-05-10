<?php

namespace App\Entity\Commission;

use App\Entity\ObjectSuperEntity;
use App\Interface\Commission\CommissionInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Commission\CommissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'commission')]
#[ORM\Index(columns: ['slug'], name: 'commission_idx')]
#[ORM\Entity(repositoryClass: CommissionRepository::class)]
#[ORM\HasLifecycleCallbacks]

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
