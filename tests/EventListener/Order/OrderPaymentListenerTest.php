<?php
namespace App\Tests\EventListener\Order;

use App\Entity\Order\Order;
use App\EventListener\Order\OrderPaymentListener;
use App\Service\Order\OrderManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderPaymentListenerTest extends TestCase
{
    public function testOnOrderPaidCallsFinalize(): void
    {
        $order = new Order();
        $manager = $this->createMock(OrderManager::class);
        $manager->expects($this->once())->method('finalize')->with($order);

        $event = new GenericEvent($order);

        $listener = new OrderPaymentListener($manager);
        $listener->onOrderPaid($event);
    }
}
