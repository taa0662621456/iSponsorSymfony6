<?php

namespace App\Twig;

use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Twig\TwigFilter;

class CountryNameExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('country_name', [$this, 'translateCountryIsoCode']),
        ];
    }

    public function translateCountryIsoCode($country, ?string $locale = null): string
    {
        $countryCode = $country instanceof CountryInterface ? $country->getCode() : $country;

        if (null === $countryCode) {
            return '';
        }

        try {
            $countryName = Countries::getName($countryCode, $locale);
        } catch (MissingResourceException) {
            return $countryCode;
        }

        return $countryName;
    }
}
