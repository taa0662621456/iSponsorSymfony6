<?php

namespace App\Entity\Product;


use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\PaymentCoreFilterTrait;
use App\Api\Filter\PriceFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Payment\PaymentMethod;
use App\Repository\Product\ProductPaymentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(
    name: 'product_payment',
    indexes: [
        new ORM\Index(columns: ['product_id'], name: 'idx_product_payment_product'),
        new ORM\Index(columns: ['method_id'], name: 'idx_product_payment_method')
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_product_payment', columns: ['product_id','method_id'])
    ])]
#[ORM\Index(columns: ['slug'], name: 'product_payment_idx')]
#[ORM\Entity(repositoryClass: ProductPaymentRepository::class)]
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
class ProductPayment
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use PaymentCoreFilterTrait;
    use RelationFilterTrait;

    #[Assert\PositiveOrZero]
    #[ORM\Column(type: 'integer')]
    private int $paymentAdjustment = 0;

    #[ORM\Column(type: 'string', length: 3, options: ['fixed' => true])]
    private string $paymentCurrency = 'USD';

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Product $paymentProduct = null;

    #[ORM\ManyToOne(targetEntity: PaymentMethod::class)]
    #[ORM\JoinColumn(name: 'method_id', nullable: false, onDelete: 'CASCADE')]
    private ?PaymentMethod $paymentMethod = null;

}
