<?php

namespace App\Dto;

trait TotpAuthenticationDTOTrait
{
    private ?string $totpSecret;

    public function isTotpAuthenticationEnabled(): bool
    {
        return (bool) $this->totpSecret;
    }

    public function getTotpAuthenticationUsername(): string
    {
        return $this->username;
    }

    public function getTotpAuthenticationConfiguration(): TotpConfigurationInterface
    {
        // You could persist the other configuration options in the user entity to make it individual per user.
        return new TotpConfiguration($this->totpSecret, TotpConfiguration::ALGORITHM_SHA1, 20, 8);
    }
}
