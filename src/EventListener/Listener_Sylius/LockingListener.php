<?php

namespace App\EventListener\Listener_Sylius;

use Doctrine\DBAL\LockMode;
use Webmozart\Assert\Assert;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

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
