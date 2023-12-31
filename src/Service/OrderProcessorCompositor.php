<?php

namespace App\Service;

use Laminas\Stdlib\PriorityQueue;

final class OrderProcessorCompositor
{
    /**
     * @var PriorityQueue|OrderProcessorInterface[]
     *
     * @psalm-var PriorityQueue<OrderProcessorInterface>
     */
    private PriorityQueue $orderProcessors;

    public function __construct()
    {
        $this->orderProcessors = new PriorityQueue();
    }

    public function addProcessor($orderProcessor, int $priority = 0): void
    {
        $this->orderProcessors->insert($orderProcessor, $priority);
    }

    public function process($order): void
    {
        foreach ($this->orderProcessors as $orderProcessor) {
            $orderProcessor->process($order);
        }
    }
}
