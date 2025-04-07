<?php

namespace App\Entity\Exchange;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Currency\CurrencyExchange;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Exchange\ExchangeRateInterface;

#[ORM\Entity]
class ExchangeRate extends RootEntity implements ObjectInterface, ExchangeRateInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToOne(targetEntity: CurrencyExchange::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $currencyExchange;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $rate;

    public function getSourceCurrency()
    {
        // TODO: Implement getSourceCurrency() method.
    }

    public function getRatio()
    {
        // TODO: Implement getRatio() method.
    }

    public function getTargetCurrency()
    {
        // TODO: Implement getTargetCurrency() method.
    }
}
