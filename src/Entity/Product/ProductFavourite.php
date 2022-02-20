<?php


namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Repository\Product\ProductFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'products_favourites')]
#[ORM\Index(columns: ['slug'], name: 'product_favourite_idx')]
#[ORM\Entity(repositoryClass: ProductFavouriteRepository::class)]
class ProductFavourite
{
	use BaseTrait;

	#[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourites')]
	#[ORM\JoinColumn(name: 'projectFavourites_id', referencedColumnName: 'id')]
	private int $productFavourites;

	public function getProductFavourites(): int
	{
		return $this->productFavourites;
	}
	public function setProductFavourites(int $productFavourites): void
	{
		$this->productFavourites = $productFavourites;
	}
}
