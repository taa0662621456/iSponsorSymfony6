<?php


namespace App\EventListener\Listener_Sylius;



use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class OrderRecalculationListener
{
    public function __construct(private OrderProcessorInterface $orderProcessor)
    {
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function recalculateOrder(GenericEvent $event): void
    {
        $order = $event->getSubject();

        Assert::isInstanceOf($order, OrderInterface::class);

        $this->orderProcessor->process($order);
    }
}
