<?php

namespace App\Entity\Product;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\BaseTrait;
use App\Repository\Product\ProductPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_payment')]
#[ORM\Index(columns: ['slug'], name: 'product_payment_idx')]
#[ORM\Entity(repositoryClass: ProductPaymentRepository::class)]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ProductPayment
{
    use BaseTrait;

}
