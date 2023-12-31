<?php

namespace App\Service\Cart;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class ExpiredCartRemover implements ExpiredCartsRemoverInterface
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly ObjectManager $orderManager,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly string $expirationPeriod,
        private readonly int $batchSize = 100,
    ) {
    }

    public function remove(): void
    {
        $expiredCarts = $this->orderRepository->findCartsNotModifiedSince(new \DateTime('-'.$this->expirationPeriod));

        $this->eventDispatcher->dispatch(new GenericEvent($expiredCarts), SyliusExpiredCartsEvents::PRE_REMOVE);

        $interval = 0;
        foreach ($expiredCarts as $expiredCart) {
            $this->orderManager->remove($expiredCart);
            $interval++;

            if (0 === $interval % $this->batchSize) {
                $this->orderManager->flush();
            }
        }

        if (0 !== $interval % $this->batchSize) {
            $this->orderManager->flush();
        }

        $this->eventDispatcher->dispatch(new GenericEvent($expiredCarts), SyliusExpiredCartsEvents::POST_REMOVE);
    }
}
