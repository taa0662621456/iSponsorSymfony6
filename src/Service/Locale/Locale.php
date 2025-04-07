<?php

namespace App\Service\Locale;

use App\EntityInterface\Locale\LocaleInterface;
use App\RepositoryInterface\Locale\LocaleRepositoryInterface;
use App\ServiceInterface\Locale\LocaleProviderServiceInterface;

final class Locale implements LocaleProviderServiceInterface, LocaleInterface
{
        private string $defaultLocaleCode;

        public function __construct(private readonly LocaleRepositoryInterface $localeRepository,
                                    ?string $defaultLocaleCode = 'EnUs')
        {
            $this->defaultLocaleCode = $defaultLocaleCode ?? 'EnUs';
        }

    public function getAvailableLocalesCodes(): array
    {
        $locales = $this->localeRepository->findAll();

        return array_map(
            function (LocaleInterface $locale) {
                return (string) $locale->getCode();
            },
            $locales
        );
    }


    public function getDefaultLocaleCode(): string
    {
        return $this->defaultLocaleCode;
    }


    public function getCode(): string
    {
        // TODO: Implement getCode() method.
        return 'EnUs';
    }
}
