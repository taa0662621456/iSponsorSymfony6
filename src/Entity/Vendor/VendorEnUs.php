<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Entity\VendorLanguageTrait;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

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
#[ORM\Entity]
final class VendorEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
    use VendorLanguageTrait;
}
