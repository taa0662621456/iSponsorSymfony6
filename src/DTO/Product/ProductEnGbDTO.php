<?php

namespace App\DTO\Product;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiFilter(SearchFilter::class, properties: [
    'firstTitle' => 'partial',
    'lastTitle' => 'partial',
    'productName' => 'partial',
    'productSDesc' => 'partial',
    'productDesc' => 'partial',
])]
final class ProductEnGbDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    #[Assert\NotBlank(message: 'product.name.blank')]
    #[Assert\NotNull(message: 'product.name.null')]
    #[Assert\Length(min: 56, minMessage: 'product.name.too.short')]
    #[Assert\Length(max: 255, maxMessage: 'product.name.too.long.')]
    private string $productNameDTO;

    #[Assert\NotBlank(message: 'product.s.description.blank')]
    #[Assert\NotNull(message: 'product.s.description.null')]
    #[Assert\Length(min: 56, minMessage: 'product.s.description.too.short')]
    #[Assert\Length(max: 15000, maxMessage: 'product.s.description.too.long.')]
    private string $productSDescDTO;

    #[Assert\NotBlank(message: 'product.description.blank')]
    #[Assert\NotNull(message: 'product.description.null')]
    #[Assert\Length(min: 56, minMessage: 'product.description.too.short')]
    #[Assert\Length(max: 15000, maxMessage: 'product.description.too.long.')]
    private string $productDescDTO;

    public function __construct(string $productName, string $productSDesc, string $productDesc)
    {
        parent::__construct();
        $this->productName = $productName;
        $this->productSDesc = $productSDesc;
        $this->productDesc = $productDesc;
    }
}
