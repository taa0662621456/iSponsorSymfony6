<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductPaymentInterface;

#[ORM\Entity]
class ProductPayment extends ObjectSuperEntity implements ObjectInterface, ProductPaymentInterface
{
}
