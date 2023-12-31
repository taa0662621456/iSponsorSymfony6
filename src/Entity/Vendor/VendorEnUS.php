<?php

namespace App\Entity\Vendor;

use App\Embeddable\Object\ObjectProperty;
use App\Embeddable\Title\ObjectTitle;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\VendorParameterTrait;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

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
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;


    use VendorParameterTrait;

    #[ORM\Embedded(class: "ObjectTitle")]
    private ObjectTitle $vendorTitle;

    #[ORM\OneToOne(inversedBy: 'vendorEnUs', targetEntity: Vendor::class)]
    #[Ignore]
    private Vendor $vendorEnUs;
}
