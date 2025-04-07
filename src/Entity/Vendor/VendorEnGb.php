<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\Embeddable\Object\ObjectTitle;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectTitleInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\VendorParameterTrait;
use ApiPlatform\Metadata\ApiResource;
use App\EntityInterface\Object\ObjectInterface;
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
class VendorEnGb extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    use VendorParameterTrait;

    #[ORM\OneToOne(inversedBy: 'vendorEnGb', targetEntity: Vendor::class)]
    #[Ignore]
    private Vendor $vendorEnGb;
}
