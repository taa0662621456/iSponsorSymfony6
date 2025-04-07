<?php

namespace App\Service\Payment;

use App\EntityInterface\Payment\PaymentInterface;
use App\EntityInterface\Payment\PaymentMethodInterface;
use App\RepositoryInterface\Payment\PaymentMethodRepositoryInterface;

final class DefaultPaymentMethodResolver
{
    public function __construct(private readonly PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
    }

    /**
     * @throws UnresolvedDefaultPaymentMethodException
     */
    public function getDefaultPaymentMethod(PaymentInterface $payment): PaymentMethodInterface
    {
        $paymentMethods = $this->paymentMethodRepository->findBy(['enabled' => true]);
        if (empty($paymentMethods)) {
            throw new UnresolvedDefaultPaymentMethodException();
        }

        return $paymentMethods[0];
    }
}
