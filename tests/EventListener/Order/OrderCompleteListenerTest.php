<?php
namespace App\Tests\EventListener\Order;

use App\Entity\Order\Order;
use App\EventListener\Order\OrderCompleteListener;
use App\Service\Order\OrderManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderCompleteListenerTest extends TestCase
{
    public function testOnOrderCompletedCallsFinalize(): void
    {
        $order = new Order();
        $manager = $this->createMock(OrderManager::class);
        $manager->expects($this->once())->method('finalize')->with($order);

        $event = new GenericEvent($order);

        $listener = new OrderCompleteListener($manager);
        $listener->onOrderCompleted($event);
    }
}
