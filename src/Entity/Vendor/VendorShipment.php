<?php

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorMessageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

/**
 * Class VendorShipment
 * @package App\Entity\Vendor
 */
#[ORM\Table(name: 'vendor_shipment')]
#[ORM\Index(columns: ['slug'], name: 'vendor_shipment_idx')]
#[ORM\Entity(repositoryClass: VendorShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#

#[ApiFilter(SearchFilter::class, properties: [
    "first_title" => "partial",
    "last_title" => "partial",
])]
class VendorShipment
{
    use BaseTrait;
    use ObjectTrait;

}