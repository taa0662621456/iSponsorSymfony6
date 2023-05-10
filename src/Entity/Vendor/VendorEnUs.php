<?php

namespace App\Entity\Vendor;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectSuperEntity;
use App\Entity\VendorLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'vendor_en_gb_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]

// HELP: https://digitalfortress.tech/tutorial/rest-api-with-symfony-and-api-platform/
#[ApiResource(
/*    collectionOperations: [],
    itemOperations: [
        'get',
        'put',
        'delete',
        'get_by_slug' => [
            'method' => 'GET',
            'path' => 'vendor/show/{slug}',
            'controller' => 'ObjectCRUDsController::class'
        ]
    ],*/
    normalizationContext: ['group' => 'read'],
    denormalizationContext: ['group' => 'write'],
    order: ['is_active' => 'DESC', 'locale' => 'ASC'],
    paginationEnabled: false
)]
final class VendorEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
    use VendorLanguageTrait;
}
