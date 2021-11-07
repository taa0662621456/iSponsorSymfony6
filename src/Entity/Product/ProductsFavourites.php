<?php
declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="products_favourites", indexes={
 * @ORM\Index(name="product_favourite_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductsFavouritesRepository")
 */
class ProductsFavourites
{
	use BaseTrait;

	/**
	 * @var int
	 *
	 * @ORM\ManyToMany(targetEntity="App\Entity\Product\Products", inversedBy="productFavourites")
	 * @ORM\JoinColumn(name="projectFavourites_id", referencedColumnName="id")
	 **/
	private $productFavourites;


	/**
	 * @return int
	 */
	public function getProductFavourites(): int
	{
		return $this->productFavourites;
	}

	/**
	 * @param int $productFavourites
	 */
	public function setProductFavourites(int $productFavourites): void
	{
		$this->productFavourites = $productFavourites;
	}

}
