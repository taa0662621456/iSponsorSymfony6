<?php
declare(strict_types=1);

namespace App\Entity\Featured;

use App\Entity\BaseTrait;
use App\Entity\Category\Category;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\Mapping as ORM;


 /**
  * @ORM\Table(name="features")
  * @ORM\Entity(repositoryClass="App\Repository\Featured\FeaturedRepository")
  * @ORM\HasLifecycleCallbacks()
  */
class Featured
{
    use BaseTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private int $ordering;

    /**
     * @var string
     *
     * @ORM\Column(name="featured_type", type="string")
     */
    private string $featuredType;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project\Project", inversedBy="projectFeatured")
	 * @ORM\JoinColumn(name="projectFeatured_id", referencedColumnName="id", nullable=true)
     */
    private Project $projectFeatured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Product", inversedBy="productFeatured")
	 * @ORM\JoinColumn(name="productFeatured_id", referencedColumnName="id", nullable=true)
     */
    private Product $productFeatured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category\Category", inversedBy="categoryFeatured")
	 * @ORM\JoinColumn(name="categoryFeatured_id", referencedColumnName="id", nullable=true)
     */
    private Category $categoryFeatured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendor", inversedBy="vendorFeatured")
	 * @ORM\JoinColumn(name="vendorFeatured_id", referencedColumnName="id", nullable=true)
     */
    private Vendor $vendorFeatured;

	/**
	 * @param $ordering
	 *
	 * @return Featured
	 */
    public function setOrdering($ordering): static
    {
        $this->ordering = $ordering;
        return $this;
    }

    /**
     * @return integer
     */
    public function getOrdering(): int
    {
        return $this->ordering;
    }

    /**
     * @return string
     */
    public function getFeaturedType(): string
    {
        return $this->featuredType;
    }

	/**
	 * @param string $featuredType
	 */
    public function setFeaturedType(string $featuredType): void
    {
        $this->featuredType = $featuredType;
    }
}
