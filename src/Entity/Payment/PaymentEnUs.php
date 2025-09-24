<?php

namespace App\Entity\Payment;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Payment\PaymentEnUSRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(
    name: 'payment_en_us',
)]
#[ORM\Index(columns: ['slug'], name: 'payment_en_idx')]
#[ORM\Entity(repositoryClass: PaymentEnUSRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]


class PaymentEnUs
{
    use BaseTrait;
    use ObjectTrait;

    #[ORM\ManyToOne(targetEntity: Payment::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Payment $payment = null;
}