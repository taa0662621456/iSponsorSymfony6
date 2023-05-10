<?php

namespace App\Entity\Product;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductTaxationInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'product_tax')]
#[ORM\Index(columns: ['slug'], name: 'product_tax_idx')]
#[ORM\HasLifecycleCallbacks]
final class ProductTaxation extends ObjectSuperEntity implements ObjectInterface, ProductTaxationInterface
{
}
