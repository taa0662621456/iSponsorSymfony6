<?php

namespace App\Entity\Order;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderPaymentInterface;
use App\Repository\OrderPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'order_payment')]
#[ORM\Index(columns: ['slug'], name: 'order_payment_idx')]
#[ORM\Entity(repositoryClass: OrderPaymentRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class OrderPayment extends ObjectSuperEntity implements ObjectInterface, OrderPaymentInterface
{

}
