<?php
namespace App\Tests\EventListener\Order;

use App\Entity\Order\Order;
use App\EventListener\Order\OrderRecalculationListener;
use App\Service\Order\OrderManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use PHPUnit\Framework\TestCase;

final class OrderRecalculationListenerTest extends TestCase
{
    public function testPostPersistCallsFinalize(): void
    {
        $order = new Order();
        $manager = $this->createMock(OrderManager::class);
        $manager->expects($this->once())->method('finalize')->with($order);

        $args = $this->createMock(LifecycleEventArgs::class);
        $args->method('getEntity')->willReturn($order);

        $listener = new OrderRecalculationListener($manager);
        $listener->postPersist($args);
    }

    public function testPostUpdateCallsFinalize(): void
    {
        $order = new Order();
        $manager = $this->createMock(OrderManager::class);
        $manager->expects($this->once())->method('finalize')->with($order);

        $args = $this->createMock(LifecycleEventArgs::class);
        $args->method('getEntity')->willReturn($order);

        $listener = new OrderRecalculationListener($manager);
        $listener->postUpdate($args);
    }
}
