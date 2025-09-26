<?php

namespace App\EventListener\Order;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Webmozart\Assert\Assert;

final class OrderIntegrityChecker
{
    public function __construct(
        private RouterInterface $router,
        private ObjectManager $manager,
        private OrderPromotionsIntegrityCheckerInterface $orderPromotionsIntegrityChecker,
    ) {
    }

    public function check(ResourceControllerEvent $event): void
    {
        $order = $event->getSubject();

        /** @var OrderInterface $order */
        Assert::isInstanceOf($order, OrderInterface::class);

        $oldTotal = $order->getTotal();

        if ($promotion = $this->orderPromotionsIntegrityChecker->check($order)) {
            $event->stop(
                'order.promotion_integrity',
                ResourceControllerEvent::TYPE_ERROR,
                ['%promotionName%' => $promotion->getName()],
            );

            $event->setResponse(new RedirectResponse($this->router->generate('shop_checkout_complete')));

            $this->manager->persist($order);
            $this->manager->flush();

            return;
        }

        if ($order->getTotal() !== $oldTotal) {
            $event->stop('order.total_integrity', ResourceControllerEvent::TYPE_ERROR);
            $event->setResponse(new RedirectResponse($this->router->generate('shop_checkout_complete')));

            $this->manager->persist($order);
            $this->manager->flush();
        }
    }
}
