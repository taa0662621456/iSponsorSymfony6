<?php

namespace App\Service\Order;


use App\Service\PriorityQueue;
use App\ServiceInterface\Order\OrderProcessorInterface;
use App\EntityInterface\Order\OrderStorageInterface;

final class CompositeOrderProcessor implements OrderProcessorInterface
{
    /**
     * @var OrderProcessorInterface[]|PriorityQueue
     *
     * @psalm-var PriorityQueue<OrderProcessorInterface>
     */
    private PriorityQueue|array $orderProcessors;

    public function __construct()
    {
        $this->orderProcessors = new PriorityQueue();
    }

    public function addProcessor(OrderProcessorInterface $orderProcessor, int $priority = 0): void
    {
        $this->orderProcessors->insert($orderProcessor, $priority);
    }

    public function process(OrderStorageInterface $order): void
    {
        foreach ($this->orderProcessors as $orderProcessor) {
            $orderProcessor->process($order);
        }
    }
}
