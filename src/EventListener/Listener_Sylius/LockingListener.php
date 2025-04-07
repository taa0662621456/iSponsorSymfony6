<?php

namespace App\EventListener\Listener_Sylius;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\PessimisticLockException;
use Webmozart\Assert\Assert;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class LockingListener
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    public function lock(GenericEvent $event): void
    {
        $subject = $event->getSubject();

        Assert::isInstanceOf($subject, VersionedInterface::class);

        try {
            $this->manager->lock($subject, LockMode::OPTIMISTIC, $subject->getVersion());
        } catch (OptimisticLockException|PessimisticLockException $e) {
        }
    }
}
