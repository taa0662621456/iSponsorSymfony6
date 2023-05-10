<?php

namespace App\Entity\Order;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\OrderPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'order_payment')]
#[ORM\Index(columns: ['slug'], name: 'order_payment_idx')]
#[ORM\Entity(repositoryClass: OrderPaymentRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class OrderPaymentEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}
