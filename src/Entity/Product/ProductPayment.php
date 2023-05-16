<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductPaymentInterface;

#[ORM\Entity]
final class ProductPayment extends ObjectSuperEntity implements ObjectInterface, ProductPaymentInterface
{
}
