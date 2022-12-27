<?php

namespace App\Entity\Order;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'order_billing')]
#[ORM\Index(columns: ['slug'], name: 'order_billing_idx')]
#[ORM\Entity(repositoryClass: OrderBillingRepository::class)]
#[ORM\HasLifecycleCallbacks]

class OrderBilling
{

}
