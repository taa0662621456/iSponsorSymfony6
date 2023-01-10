<?php

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Repository\Vendor\VendorMessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VendorShipment
 * @package App\Entity\Vendor
 */
#[ORM\Table(name: 'vendor_shipment')]
#[ORM\Index(columns: ['slug'], name: 'vendor_shipment_idx')]
#[ORM\Entity(repositoryClass: VendorShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "first_title" => "partial",
    "last_title" => "partial",
])]
class VendorShipment
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;

}
