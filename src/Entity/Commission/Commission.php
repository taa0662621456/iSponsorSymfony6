<?php

namespace App\Entity\Commission;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Commission\CommissionInterface;

#[ORM\Entity]
class Commission extends RootEntity implements ObjectInterface, CommissionInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'commission')]
    private ObjectProperty $objectProperty;


}
