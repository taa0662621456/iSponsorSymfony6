<?php

namespace App\Entity\Commission;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Commission\CommissionInterface;

#[ORM\Entity]
class CommissionType extends RootEntity implements ObjectInterface, CommissionInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Column(type: 'string', length: 255)]
    public $incrementCommission;

    #[ORM\Column(type: 'string', length: 255)]
    public $decrementCommission;

    #[ORM\Column(type: 'string', length: 255)]
    public $additionCommission;

    #[ORM\Column(type: 'string', length: 255)]
    public $multiplicationCommission;

    #[ORM\Column(type: 'string', length: 255)]
    public $subtractionCommission;
}
