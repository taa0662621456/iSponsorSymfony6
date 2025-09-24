<?php
namespace App\Tests\Integration\EventListener\Order;

use App\Entity\Order\Order;
use App\EventListener\Order\OrderCompleteListener;
use App\Service\Order\OrderManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderCompleteListenerIntegrationTest extends KernelTestCase
{
    public function testOrderCompletedEventTriggersFinalize(): void
    {
        self::bootKernel();

        $manager = $this->createMock(OrderManager::class);
        $manager->expects($this->once())->method('finalize');

        $listener = new OrderCompleteListener($manager);

        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('order.completed', [$listener, 'onOrderCompleted']);

        $order = new Order();
        $dispatcher->dispatch(new GenericEvent($order), 'order.completed');
    }
}
