<?php

namespace App\Entity\Product;


use ApiPlatform\Doctrine\Odm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Repository\Product\ProductPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_payment')]
#[ORM\Index(columns: ['slug'], name: 'product_payment_idx')]
#[ORM\Entity(repositoryClass: ProductPaymentRepository::class)]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
class ProductPayment
{
    use ObjectBaseTrait;
}
