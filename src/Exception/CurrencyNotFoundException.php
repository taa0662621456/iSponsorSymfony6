<?php

namespace App\Exception;

use Exception;
use RuntimeException;

final class CurrencyNotFoundException extends RuntimeException
{
    public function __construct(string $message = null, Exception $previousException = null)
    {
        parent::__construct($message ?: 'Currency could not be found!', 0, $previousException);
    }

    public static function notFound(string $currencyCode): self
    {
        return new self(sprintf('Currency "%s" cannot be found!', $currencyCode));
    }

    public static function disabled(string $currencyCode): self
    {
        return new self(sprintf('Currency "%s" is disabled!', $currencyCode));
    }

    /**
     * @param array|string[] $availableCurrenciesCodes
     */
    public static function notAvailable(string $currencyCode, array $availableCurrenciesCodes): self
    {
        return new self(sprintf(
            'Currency "%s" is not available! The available ones are: "%s".',
            $currencyCode,
            implode('", "', $availableCurrenciesCodes),
        ));
    }
}
