<?php
namespace App\Service\Order;

use App\Entity\Order\Order;
use Doctrine\ORM\EntityManagerInterface;

final class OrderManager
{
    public function __construct(
        private readonly OrderProcessorPipeline $pipeline,
        private readonly EntityManagerInterface $em
    ) {}

    public function finalize(Order $order): void
    {
        $this->pipeline->process($order);
        $this->em->persist($order);
        $this->em->flush();
    }
}
