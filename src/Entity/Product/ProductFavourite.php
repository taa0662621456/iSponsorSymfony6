<?php


namespace App\Entity\Product;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\ObjectBaseTrait;
use App\Repository\Product\ProductFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_favourite')]
#[ORM\Index(columns: ['slug'], name: 'product_favourite_idx')]
#[ORM\Entity(repositoryClass: ProductFavouriteRepository::class)]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ProductFavourite
{
	use ObjectBaseTrait;

	#[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourite')]
	private Product $productFavourite;

	public function getProductFavourite(): Product
	{
		return $this->productFavourite;
	}

	public function setProductFavourite(Product $productFavourite): void
	{
		$this->productFavourite = $productFavourite;
	}
}
