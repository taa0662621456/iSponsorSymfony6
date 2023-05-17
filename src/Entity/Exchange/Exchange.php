<?php

namespace App\Entity\Exchange;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Currency\Currency;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Exchange\ExchangeInterface;

#[ORM\Entity]
class Exchange extends ObjectSuperEntity implements ObjectInterface, ExchangeInterface
{
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
