<?php

namespace App\Service\Currency;

use Symfony\Component\Intl\Currencies;

class CurrencyCodeToNameConverter implements CurrencyNameConverterInterface
{
    public function convertToCode(string $name, string $locale = null): string
    {
        $names = Currencies::getNames($locale ?? 'en');
        $currencyCode = array_search($name, $names, true);

        if (false === $currencyCode) {
            throw new \InvalidArgumentException(sprintf('Currency "%s" not found! Available names: %s.', $name, implode(', ', $names)));
        }

        return $currencyCode;
    }
}
