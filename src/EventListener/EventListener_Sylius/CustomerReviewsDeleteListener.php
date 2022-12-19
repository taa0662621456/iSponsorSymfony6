<?php


namespace App\CoreBundle\EventListener;



use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class CustomerReviewsDeleteListener
{
    public function __construct(private ReviewerReviewsRemoverInterface $reviewerReviewsRemover)
    {
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function removeCustomerReviews(GenericEvent $event): void
    {
        $author = $event->getSubject();
        Assert::isInstanceOf($author, ReviewerInterface::class);

        $this->reviewerReviewsRemover->removeReviewerReviews($author);
    }
}
