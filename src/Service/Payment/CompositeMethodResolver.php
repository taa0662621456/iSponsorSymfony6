<?php

namespace App\Service\Payment;

final class CompositeMethodResolver implements PaymentMethodsResolverInterface
{
    public function __construct(private readonly PrioritizedServiceRegistryInterface $resolversRegistry)
    {
    }

    public function getSupportedMethods(PaymentInterface $subject): array
    {
        /** @var PaymentMethodsResolverInterface $resolver */
        foreach ($this->resolversRegistry->all() as $resolver) {
            if ($resolver->supports($subject)) {
                return $resolver->getSupportedMethods($subject);
            }
        }

        return [];
    }

    public function supports(PaymentInterface $subject): bool
    {
        /** @var PaymentMethodsResolverInterface $resolver */
        foreach ($this->resolversRegistry->all() as $resolver) {
            if ($resolver->supports($subject)) {
                return true;
            }
        }

        return false;
    }
}
