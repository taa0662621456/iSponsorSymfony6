<?php
namespace App\Tests\Service\Order;

use App\Entity\Order\Order;
use App\Service\Order\OrderProcessorInterface;
use App\Service\Order\OrderProcessorPipeline;
use PHPUnit\Framework\TestCase;

final class OrderProcessorPipelineTest extends TestCase
{
    public function testPipelineRunsAllProcessors(): void
    {
        $order = new Order();

        $processor1 = $this->createMock(OrderProcessorInterface::class);
        $processor1->expects($this->once())->method('process')->with($order);

        $processor2 = $this->createMock(OrderProcessorInterface::class);
        $processor2->expects($this->once())->method('process')->with($order);

        $pipeline = new OrderProcessorPipeline([$processor1, $processor2]);
        $pipeline->process($order);
    }
}
