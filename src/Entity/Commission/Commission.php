<?php

namespace App\Entity\Commission;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Commission\CommissionInterface;

#[ORM\Entity]
class Commission extends ObjectSuperEntity implements ObjectInterface, CommissionInterface
{
    // TODO: комиссии, налагаемые на способы доставки, оплаты и пр.
    /*
     * percentCommission
     * fixedCommission
     *
     *
     */
}
