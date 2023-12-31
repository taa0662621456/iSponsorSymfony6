<?php

namespace App\Entity\Product;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;
use App\EntityInterface\Product\ProductTitleInterface;

#[ORM\Entity]
class ProductEnGb extends RootEntity implements ObjectInterface, ObjectTitleInterface, ProductTitleInterface
{
}
