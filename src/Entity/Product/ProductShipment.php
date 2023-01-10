<?php


namespace App\Entity\Product;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\ObjectBaseTrait;
use App\Repository\Product\ProductShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_shipment')]
#[ORM\Index(columns: ['slug'], name: 'product_shipment_idx')]
#[ORM\Entity(repositoryClass: ProductShipmentRepository::class)]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ProductShipment
{
    use ObjectBaseTrait;

}
