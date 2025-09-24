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
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\ShipmentCoreFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Shipment\ShipmentMethod;
use App\Repository\Product\ProductShipmentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(
    name: 'product_shipment',
    indexes: [
        new ORM\Index(columns: ['product_id'], name: 'idx_product_shipment_product'),
        new ORM\Index(columns: ['shipment_method_id'], name: 'idx_product_shipment_method')
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_product_shipment', columns: ['product_id','shipment_method_id'])
    ]

)]
#[ORM\Index(columns: ['slug'], name: 'product_shipment_idx')]
#[ORM\Entity(repositoryClass: ProductShipmentRepository::class)]
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
class ProductShipment
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use ShipmentCoreFilterTrait;
    use RelationFilterTrait;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Product $product = null;

    #[ORM\ManyToOne(targetEntity: ShipmentMethod::class)]
    #[ORM\JoinColumn(name: 'shipment_method_id', nullable: false, onDelete: 'CASCADE')]
    private ?ShipmentMethod $productShipmentMethod = null;

    #[Assert\PositiveOrZero]
    #[ORM\Column(type: 'integer')]
    private int $productShipmentExtraFee = 0;

    #[ORM\Column(type: 'string', length: 3, options: ['fixed' => true])]
    private string $productShipmentExtraFeeCurrency = 'USD';


}
