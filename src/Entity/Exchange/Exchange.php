<?php

namespace App\Entity\Exchange;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Currency\Currency;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Exchange\ExchangeInterface;

#[ORM\Entity]
class Exchange extends RootEntity implements ObjectInterface, ExchangeInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'exchange')]
    private ObjectProperty $objectProperty;


    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $rate;

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $sourceCurrency;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $targetCurrency;
}
