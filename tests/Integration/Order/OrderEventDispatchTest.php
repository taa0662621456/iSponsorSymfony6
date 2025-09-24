<?php
namespace App\Tests\Integration\Order;

use App\Entity\Order\OrderStorage;
use App\Event\OrderPaidEvent;
use App\Event\OrderShippedEvent;
use App\Event\OrderCompletedEvent;
use App\Tests\Stub\TestOrderEventListener;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class OrderEventDispatchTest extends KernelTestCase
{
    private EntityManagerInterface $em;
    private TestOrderEventListener $listener;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->em = static::getContainer()->get(EntityManagerInterface::class);
        $dispatcher = static::getContainer()->get(EventDispatcherInterface::class);

        // подключаем тестового listener
        $this->listener = new TestOrderEventListener();
        $dispatcher->addSubscriber($this->listener);

        // очищаем таблицы
        $this->em->createQuery('DELETE FROM App\Entity\Order\OrderStatusHistory')->execute();
        $this->em->createQuery('DELETE FROM App\Entity\Order\OrderStorage')->execute();
    }

    public function testEventsAreDispatchedOnOrderLifecycle(): void
    {
        $order = new OrderStorage();
        $this->em->persist($order);
        $this->em->flush();

        // pay()
        $order->pay('tester1');
        $this->em->flush();

        // ship()
        $order->ship('tester2');
        $this->em->flush();

        // complete()
        $order->complete('tester3');
        $this->em->flush();

        // Проверяем, что события пришли
        $this->assertCount(3, $this->listener->events);

        $this->assertInstanceOf(OrderPaidEvent::class, $this->listener->events[0]);
        $this->assertInstanceOf(OrderShippedEvent::class, $this->listener->events[1]);
        $this->assertInstanceOf(OrderCompletedEvent::class, $this->listener->events[2]);

        // Проверим порядок
        $this->assertSame($order, $this->listener->events[0]->order);
        $this->assertSame($order, $this->listener->events[1]->order);
        $this->assertSame($order, $this->listener->events[2]->order);
    }
}
