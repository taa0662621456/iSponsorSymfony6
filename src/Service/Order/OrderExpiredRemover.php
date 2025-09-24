<?php

namespace App\Service\Order;

use App\RepositoryInterface\Order\OrderRepositoryInterface;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class OrderExpiredRemover
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
        try {
            $expiredCarts = $this->orderRepository->findCartsNotModifiedSince(new DateTime('-' . $this->expirationPeriod));
        } catch (\Exception $e) {
        }

        $this->eventDispatcher->dispatch(new GenericEvent($expiredCarts), ExpiredOrderEvent::PRE_REMOVE);

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

        $this->eventDispatcher->dispatch(new GenericEvent($expiredCarts), ExpiredOrderEvent::POST_REMOVE);
    }
}