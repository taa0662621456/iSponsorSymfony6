<?php

namespace App\Entity\Commission;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Commission\CommissionInterface;

#[ORM\Entity]
class CommissionDirection extends RootEntity implements ObjectInterface, CommissionInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


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
}