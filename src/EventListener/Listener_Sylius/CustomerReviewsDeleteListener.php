<?php

namespace App\EventListener\Listener_Sylius;

use InvalidArgumentException;
use Webmozart\Assert\Assert;
use Symfony\Component\EventDispatcher\GenericEvent;

final class CustomerReviewsDeleteListener
{
    public function __construct(private readonly ReviewerReviewsRemoverInterface $reviewerReviewsRemover)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function removeCustomerReviews(GenericEvent $event): void
    {
        $author = $event->getSubject();
        Assert::isInstanceOf($author, ReviewerInterface::class);

        $this->reviewerReviewsRemover->removeReviewerReviews($author);
    }
}
