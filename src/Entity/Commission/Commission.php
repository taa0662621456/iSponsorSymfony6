<?php

namespace App\Entity\Commission;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Commission\CommissionInterface;

#[ORM\Entity]
class Commission extends RootEntity implements ObjectInterface, CommissionInterface
{
    // TODO: комиссии, налагаемые на способы доставки, оплаты и пр.
    /*
     * percentCommission
     * fixedCommission
     *
     *
     */
}
