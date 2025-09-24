<?php
namespace App\Tests\Entity\Order;

use App\Entity\Order\OrderStorage;
use App\Enum\OrderStatus;
use App\Event\OrderPaidEvent;
use App\Event\OrderCancelledEvent;
use App\Event\OrderRefundedEvent;
use App\Event\OrderShippedEvent;
use App\Event\OrderCompletedEvent;
use PHPUnit\Framework\TestCase;

class OrderStorageTest extends TestCase
{
    public function testPay(): void
    {
        $order = new OrderStorage();

        $order->pay('user1');

        $this->assertSame(OrderStatus::PAID, $order->getStatus());
        $this->assertNotNull($this->getProperty($order, 'paidAt'));
        $this->assertCount(1, $order->getOrderStatusHistory());
        $this->assertInstanceOf(OrderPaidEvent::class, $order->releaseEvents()[0]);
    }

    public function testCancelFromNew(): void
    {
        $order = new OrderStorage();

        $order->cancel('user2');

        $this->assertSame(OrderStatus::CANCELLED, $order->getStatus());
        $this->assertNotNull($this->getProperty($order, 'cancelledAt'));
        $this->assertCount(1, $order->getOrderStatusHistory());
        $this->assertInstanceOf(OrderCancelledEvent::class, $order->releaseEvents()[0]);
    }

    public function testRefundFromPaid(): void
    {
        $order = new OrderStorage();
        $this->setOrderStatus($order, OrderStatus::PAID);

        $order->refund('user3');

        $this->assertSame(OrderStatus::REFUNDED, $order->getStatus());
        $this->assertNotNull($this->getProperty($order, 'refundedAt'));
        $this->assertCount(1, $order->getOrderStatusHistory());
        $this->assertInstanceOf(OrderRefundedEvent::class, $order->releaseEvents()[0]);
    }

    public function testShip(): void
    {
        $order = new OrderStorage();
        $this->setOrderStatus($order, OrderStatus::PAID);

        $order->ship('user4');

        $this->assertSame(OrderStatus::SHIPPED, $order->getStatus());
        $this->assertCount(1, $order->getOrderStatusHistory());
        $this->assertInstanceOf(OrderShippedEvent::class, $order->releaseEvents()[0]);
    }

    public function testComplete(): void
    {
        $order = new OrderStorage();
        $this->setOrderStatus($order, OrderStatus::SHIPPED);

        $order->complete('user5');

        $this->assertSame(OrderStatus::COMPLETED, $order->getStatus());
        $this->assertCount(1, $order->getOrderStatusHistory());
        $this->assertInstanceOf(OrderCompletedEvent::class, $order->releaseEvents()[0]);
    }

    public function testCancelInvalidThrowsException(): void
    {
        $order = new OrderStorage();
        $this->setOrderStatus($order, OrderStatus::SHIPPED);

        $this->expectException(\DomainException::class);
        $order->cancel();
    }

    private function setOrderStatus(OrderStorage $order, OrderStatus $status): void
    {
        $ref = new \ReflectionProperty($order, 'status');
        $ref->setAccessible(true);
        $ref->setValue($order, $status);
    }

    private function getProperty(object $object, string $property): mixed
    {
        $ref = new \ReflectionProperty($object, $property);
        $ref->setAccessible(true);
        return $ref->getValue($object);
    }
}
