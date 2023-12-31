<?php

namespace App\EventListener\Listener_Sylius;

use Webmozart\Assert\Assert;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ReviewCreateListener
{
    public function __construct(private CustomerContextInterface $customerContext)
    {
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function ensureReviewHasAuthor(GenericEvent $event): void
    {
        $subject = $event->getSubject();

        Assert::isInstanceOf($subject, ReviewInterface::class);

        if (null !== $subject->getAuthor()) {
            return;
        }

        $customer = $this->customerContext->getCustomer();

        Assert::isInstanceOf($customer, CustomerInterface::class);

        $subject->setAuthor($customer);
    }
}
