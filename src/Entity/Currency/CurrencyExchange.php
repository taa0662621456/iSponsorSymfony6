<?php

namespace App\Entity\Currency;

use App\Entity\BaseTrait;

class CurrencyExchange
{
    use BaseTrait;

    protected $currencySource;

    protected $currencyTarget;

    protected $currencyRatio;

}
