<?php

namespace App\Entity\Exchange;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Currency\CurrencyExchange;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Exchange\ExchangeRateInterface;

#[ORM\Entity]
class ExchangeRate extends RootEntity implements ObjectInterface, ExchangeRateInterface
{
    #[ORM\ManyToOne(targetEntity: CurrencyExchange::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $currencyExchange;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $rate;
}
