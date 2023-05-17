<?php

namespace App\Entity\Commission;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Commission\CommissionInterface;

#[ORM\Entity]
class CommissionDirection extends ObjectSuperEntity implements ObjectInterface, CommissionInterface
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
}
