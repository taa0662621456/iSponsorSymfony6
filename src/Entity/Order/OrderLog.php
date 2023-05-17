<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderLogInterface;

#[ORM\Entity]
class OrderLog extends ObjectSuperEntity implements ObjectInterface, OrderLogInterface
{
    #[ORM\ManyToOne(targetEntity: OrderStatus::class)]
    private OrderStatus $orderStatusCode;

    #[ORM\Column(name: 'customer_notified', type: 'boolean', nullable: false)]
    private bool $customerNotified = false;

    #[ORM\Column(name: 'comment')]
    private ?string $comment = null;

    #[ORM\Column(name: 'o_hash')]
    private ?string $oHash = null;

}
