<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;

final class ReviewListener
{
    public function __construct(private readonly ReviewableRatingUpdaterInterface $averageRatingUpdater)
    {
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->recalculateSubjectRating($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->recalculateSubjectRating($args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->recalculateSubjectRating($args);
    }

    public function recalculateSubjectRating(LifecycleEventArgs $args): void
    {
        $subject = $args->getObject();

        if (!$subject instanceof ReviewInterface) {
            return;
        }

        $this->averageRatingUpdater->update($subject->getReviewSubject());
    }
}
