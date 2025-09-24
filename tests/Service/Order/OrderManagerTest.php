<?php
namespace App\Tests\Service\Order;

use App\Entity\Order\Order;
use App\Service\Order\OrderManager;
use App\Service\Order\OrderProcessorPipeline;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class OrderManagerTest extends TestCase
{
    public function testFinalizePersistsOrder(): void
    {
        $order = new Order();

        $pipeline = $this->createMock(OrderProcessorPipeline::class);
        $pipeline->expects($this->once())->method('process')->with($order);

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())->method('persist')->with($order);
        $em->expects($this->once())->method('flush');

        $manager = new OrderManager($pipeline, $em);
        $manager->finalize($order);
    }
}
