<?php

namespace App\Service\Currency;

use App\EntityInterface\Exchange\ExchangeRateInterface;
use App\RepositoryInterface\Exchange\ExchangeRateRepositoryInterface;

final class CurrencyConverter
{
    /** @var array|ExchangeRateInterface[] */
    private ?array $cache = null;

    public function __construct(private readonly ExchangeRateRepositoryInterface $exchangeRateRepository)
    {
    }

    public function convert(int $value, string $sourceCurrencyCode, string $targetCurrencyCode): int
    {
        if ($sourceCurrencyCode === $targetCurrencyCode) {
            return $value;
        }

        $exchangeRate = $this->findExchangeRate($sourceCurrencyCode, $targetCurrencyCode);

        if (null === $exchangeRate) {
            return $value;
        }

        if ($exchangeRate->getSourceCurrency()->getCode() === $sourceCurrencyCode) {
            return (int) round($value * $exchangeRate->getRatio());
        }

        return (int) round($value / $exchangeRate->getRatio());
    }

    private function findExchangeRate(string $sourceCode, string $targetCode): ?ExchangeRateInterface
    {
        $sourceTargetIndex = $this->createIndex($sourceCode, $targetCode);

        if (isset($this->cache[$sourceTargetIndex])) {
            return $this->cache[$sourceTargetIndex];
        }

        $targetSourceIndex = $this->createIndex($targetCode, $sourceCode);

        if (isset($this->cache[$targetSourceIndex])) {
            return $this->cache[$targetSourceIndex];
        }

        return $this->cache[$sourceTargetIndex] = $this->exchangeRateRepository->findOneWithCurrencyPair($sourceCode, $targetCode);
    }

    private function createIndex(string $prefix, string $suffix): string
    {
        return sprintf('%s-%s', $prefix, $suffix);
    }
}
