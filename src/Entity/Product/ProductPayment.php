<?php

namespace App\Entity\Product;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductPaymentInterface;

#[ORM\Entity]
class ProductPayment extends RootEntity implements ObjectInterface, ProductPaymentInterface
{
}
