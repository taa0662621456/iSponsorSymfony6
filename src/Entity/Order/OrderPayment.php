<?php

namespace App\Entity\Order;


use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\OrderPaymentEnGbFilterTrial;
use App\Api\Filter\PaymentCoreFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Order\OrderPaymentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;


#[ORM\Table(name: 'order_payment')]
#[ORM\Index(columns: ['slug'], name: 'order_payment_idx')]
#[ORM\Entity(repositoryClass: OrderPaymentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class OrderPayment
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use PaymentCoreFilterTrait;
    use RelationFilterTrait;

    #[ORM\ManyToOne(targetEntity: OrderStorage::class, inversedBy: 'payments')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?OrderStorage $order = null;

    public function getOrder(): ?OrderStorage
    {
        return $this->order;
    }

    public function setOrder(?OrderStorage $order): void
    {
        $this->order = $order;
        if ($order !== null && !$order->getPayment()->contains($this)) {
            $order->addPayment($this);
        }
    }

}
