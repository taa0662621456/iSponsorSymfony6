<?php


namespace App\CoreBundle\EventListener;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class LockingListener
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function lock(GenericEvent $event): void
    {
        $subject = $event->getSubject();

        Assert::isInstanceOf($subject, VersionedInterface::class);

        $this->manager->lock($subject, LockMode::OPTIMISTIC, $subject->getVersion());
    }
}
