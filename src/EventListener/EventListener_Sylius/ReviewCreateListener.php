<?php


namespace App\EventListener\EventListener_Sylius;




use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

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
