<?php

namespace App\Interface\Currency;

interface CurrencyInterface
{
    public function setCode(mixed $currencyCode): void;
}
