<?php

namespace App\Factory;

use App\Interface\FactoryInterface;

final class PaymentFactory implements PaymentFactoryInterface
{
    public function __construct(private readonly FactoryInterface $factory)
    {
    }

    public function createNew(): PaymentInterface
    {
        return $this->factory->createNew();
    }

    public function createWithAmountAndCurrencyCode(int $amount, string $currency): PaymentInterface
    {
        /** @var PaymentInterface $payment */
        $payment = $this->factory->createNew();
        $payment->setAmount($amount);
        $payment->setCurrencyCode($currency);

        return $payment;
    }
}
