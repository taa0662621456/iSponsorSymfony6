<?php

namespace App\Service\Currency;

use InvalidArgumentException;
use Symfony\Component\Intl\Currencies;

class CurrencyCodeToNameConverter
{
    public function convertToCode(string $currencyName, string $locale = null): string
    {
        $names = Currencies::getNames($locale ?? 'en');
        $currencyCode = array_search($currencyName, $names, true);

        if (false === $currencyCode) {
            throw new InvalidArgumentException(sprintf('Currency "%s" not found! Available names: %s.', $currencyName, implode(', ', $names)));
        }

        return $currencyCode;
    }
}
