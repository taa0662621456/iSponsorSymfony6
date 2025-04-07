<?php

namespace App\Service\Money;

use App\ServiceInterface\Money\MoneyFormatterInterface;
use NumberFormatter;
use Webmozart\Assert\Assert;
use function gettype;

final class MoneyFormatter implements MoneyFormatterInterface
{
    public function format(int $amount, string $currencyCode, string $locale = null): string
    {
        $formatter = new NumberFormatter($locale ?? 'en', NumberFormatter::CURRENCY);

        $result = $formatter->formatCurrency(abs($amount / 100), $currencyCode);
        Assert::notSame(
            false,
            $result,
            sprintf('The amount "%s" of type %s cannot be formatted to currency "%s".', $amount, gettype($amount), $currencyCode),
        );

        return $amount >= 0 ? $result : '-'.$result;
    }
}
