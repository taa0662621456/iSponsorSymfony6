<?php

namespace App\Entity\Currency;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use App\Interface\Currency\CurrencyExchangeInterface;

#[ApiResource(mercure: true)]
#[ORM\Entity]
final class CurrencyExchange extends ObjectSuperEntity implements ObjectInterface, CurrencyExchangeInterface
{
    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $currencySource;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $currencyTarget;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $currencyRatio;
}
