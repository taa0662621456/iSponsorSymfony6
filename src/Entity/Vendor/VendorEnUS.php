<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\VendorLanguageTrait;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

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
class VendorEnUS extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    use VendorLanguageTrait;
}
