<?php

namespace App\Entity\Address;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\GeoAddressFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Controller\ObjectCRUDsController;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address')]
#[ORM\Index(columns: ['slug'], name: 'address_idx')]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
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
class Address
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    #
    use TimestampFilterTrait;
    use GeoAddressFilterTrait;
    use RelationFilterTrait;
}
