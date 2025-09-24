<?php

namespace App\Tests\Stub;

use App\Event\OrderPaidEvent;
use App\Event\OrderShippedEvent;
use App\Event\OrderCompletedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderEventListenerStubTest implements EventSubscriberInterface
{
    public array $events = [];

    public static function getSubscribedEvents(): array
    {
        return [
            OrderPaidEvent::class => 'onPaid',
            OrderShippedEvent::class => 'onShipped',
            OrderCompletedEvent::class => 'onCompleted',
        ];
    }

    public function onPaid(OrderPaidEvent $event): void
    {
        $this->events[] = $event;
    }

    public function onShipped(OrderShippedEvent $event): void
    {
        $this->events[] = $event;
    }

    public function onCompleted(OrderCompletedEvent $event): void
    {
        $this->events[] = $event;
    }
}
