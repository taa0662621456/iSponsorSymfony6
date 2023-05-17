<?php

namespace App\Service\Currency;

use App\EntityInterface\Currency\CurrencyInterface;
use App\EntityInterface\Exchange\ExchangeRateInterface;
use App\RepositoryInterface\Exchange\ExchangeRateRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Webmozart\Assert\Assert;

class UniqueCurrencyPairValidator extends ConstraintValidator
{
    public function __construct(private readonly ExchangeRateRepositoryInterface $exchangeRateRepository)
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        /* @var UniqueCurrencyPair $constraint */
        Assert::isInstanceOf($constraint, UniqueCurrencyPair::class);

        if (!$value instanceof ExchangeRateInterface) {
            throw new UnexpectedTypeException($value, ExchangeRateInterface::class);
        }

        if (null !== $value->getId()) {
            return;
        }

        if (null === $value->getSourceCurrency() || null === $value->getTargetCurrency()) {
            return;
        }

        if (!$this->isCurrencyPairUnique($value->getSourceCurrency(), $value->getTargetCurrency())) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }

    private function isCurrencyPairUnique(CurrencyInterface $baseCurrency, CurrencyInterface $targetCurrency): bool
    {
        $exchangeRate = $this->exchangeRateRepository->findOneWithCurrencyPair($baseCurrency->getCode(), $targetCurrency->getCode());

        return null === $exchangeRate;
    }
}
