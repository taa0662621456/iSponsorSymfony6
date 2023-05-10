<?php

namespace App\Entity\Payment;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\PaymentEnRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'payment_en')]
#[ORM\Index(columns: ['slug'], name: 'payment_en_idx')]
#[ORM\Entity(repositoryClass: PaymentEnRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class PaymentEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{

}
