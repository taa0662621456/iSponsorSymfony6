<?php

namespace App\Entity\Order;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderBillingInterface;
use App\Repository\Order\OrderBillingRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'order_billing')]
#[ORM\Index(columns: ['slug'], name: 'order_billing_idx')]
#[ORM\Entity(repositoryClass: OrderBillingRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class OrderBilling extends ObjectSuperEntity implements ObjectInterface, OrderBillingInterface
{
}
