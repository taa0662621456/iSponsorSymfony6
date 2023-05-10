<?php

namespace App\Entity\Product;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductPaymentInterface;
use App\Repository\Product\ProductPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_payment')]
#[ORM\Index(columns: ['slug'], name: 'product_payment_idx')]
#[ORM\Entity(repositoryClass: ProductPaymentRepository::class)]

final class ProductPayment extends ObjectSuperEntity implements ObjectInterface, ProductPaymentInterface
{
}
