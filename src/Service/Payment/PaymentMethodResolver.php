<?php

namespace App\Service\Payment;

use Composer\Repository\RepositoryInterface;

final class PaymentMethodResolver implements PaymentMethodsResolverInterface
{
    public function __construct(private readonly RepositoryInterface $paymentMethodRepository)
    {
    }

    public function getSupportedMethods(PaymentInterface $subject): array
    {
        return $this->paymentMethodRepository->findBy(['enabled' => true]);
    }

    public function supports(PaymentInterface $subject): bool
    {
        return true;
    }
}
