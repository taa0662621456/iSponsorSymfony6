<?php

namespace App\Twig;

use Twig\TwigFilter;

class ProvinceNamingExtension
{
    public function __construct(private $provinceNamingProvider)
    {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('province_name', [$this->provinceNamingProvider, 'getName']),
            new TwigFilter('province_abbreviation', [$this->provinceNamingProvider, 'getAbbreviation']),
        ];
    }
}