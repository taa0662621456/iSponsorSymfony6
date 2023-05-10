<?php

namespace App\DTO\Currency;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

#[ApiResource(mercure: true)]
final class CurrencyExchangeDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    protected $currencySource;

    protected $currencyTarget;

    protected $currencyRatio;
}
