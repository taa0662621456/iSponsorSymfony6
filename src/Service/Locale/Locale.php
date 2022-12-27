<?php

namespace App\Service\Locale;

use App\Interface\Locale\LocaleInterface;
use App\Interface\RepositoryInterface;

final class Locale implements LocaleProviderInterface
{
    public function __construct(private readonly RepositoryInterface $localeRepository, private readonly string $defaultLocaleCode)
    {
    }

    public function getAvailableLocalesCodes(): array
    {
        $locales = $this->localeRepository->findAll();

        return array_map(
            function (LocaleInterface $locale) {
                return (string) $locale->getCode();
            },
            $locales,
        );
    }

    public function getDefaultLocaleCode(): string
    {
        return $this->defaultLocaleCode;
    }
}
