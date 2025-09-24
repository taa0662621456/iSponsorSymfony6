<?php

namespace App\Service\Payment;

final class DefaultPaymentMethodResolver implements DefaultPaymentMethodResolverInterface
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