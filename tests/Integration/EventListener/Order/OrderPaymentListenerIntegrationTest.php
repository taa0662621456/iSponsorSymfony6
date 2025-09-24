<?php
namespace App\Tests\Integration\EventListener\Order;

use App\Entity\Order\Order;
use App\EventListener\Order\OrderPaymentListener;
use App\Service\Order\OrderManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderPaymentListenerIntegrationTest extends KernelTestCase
{
    public function testOrderPaidEventTriggersFinalize(): void
    {
        self::bootKernel();

        $manager = $this->createMock(OrderManager::class);
        $manager->expects($this->once())->method('finalize');

        $listener = new OrderPaymentListener($manager);

        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('order.paid', [$listener, 'onOrderPaid']);

        $order = new Order();
        $dispatcher->dispatch(new GenericEvent($order), 'order.paid');
    }
}
