<?php

namespace App\Service\Locale;

use App\Interface\Locale\LocaleInterface;
use App\Interface\Locale\LocaleProviderInterface;
use App\Interface\Locale\LocaleRepositoryInterface;

final class Locale implements LocaleProviderInterface, LocaleInterface
{
/*    private string $defaultLocaleCode;

    public function __construct(private readonly LocaleRepositoryInterface $localeRepository,
                                ?string $defaultLocaleCode)
    {
        $this->defaultLocaleCode = $defaultLocaleCode ?? 'EnUs';
    }*/


/*    public function getAvailableLocalesCodes(): array
    {
        $locales = $this->localeRepository->findAll();

        return array_map(
            function (LocaleInterface $locale) {
                return (string) $locale->getCode();
            },
            $locales,
        );
    }*/

/*    public function getDefaultLocaleCode(): string
    {
        return $this->defaultLocaleCode;
    }*/

    public function getCode(): string
    {
        // TODO: Implement getCode() method.
        return 'EnUs';
    }
}
