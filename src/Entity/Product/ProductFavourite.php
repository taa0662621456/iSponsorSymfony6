<?php


namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Repository\Product\ProductFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_favourite')]
#[ORM\Index(columns: ['slug'], name: 'product_favourite_idx')]
#[ORM\Entity(repositoryClass: ProductFavouriteRepository::class)]
class ProductFavourite
{
	use BaseTrait;

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
