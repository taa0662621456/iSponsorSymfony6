<?php

namespace App\EventListener\Listener_Sylius;

use App\ServiceInterface\Order\OrderProcessorInterface;
use InvalidArgumentException;
use Webmozart\Assert\Assert;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderRecalculationListener
{
    public function __construct(private readonly OrderProcessorInterface $orderProcessor)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function recalculateOrder(GenericEvent $event): void
    {
        $order = $event->getSubject();

        Assert::isInstanceOf($order, OrderInterface::class);

        $this->orderProcessor->process($order);
    }
}
