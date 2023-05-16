<?php

namespace App\Entity\Exchange;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Entity\Currency\CurrencyExchange;
use App\Interface\Object\ObjectInterface;
use App\Interface\Exchange\ExchangeRateInterface;

#[ORM\Entity]
final class ExchangeRate extends ObjectSuperEntity implements ObjectInterface, ExchangeRateInterface
{
    #[ORM\ManyToOne(targetEntity: CurrencyExchange::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $currencyExchange;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $rate;
}
