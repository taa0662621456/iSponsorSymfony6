<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


 /**
  * @ORM\Table(name="featured")
  * @ORM\Entity(repositoryClass="App\Repository\FeaturedRepository")
  */
class Featured
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private $ordering;

    /**
     * @var string
     *
     * @ORM\Column(name="featured_type", type="string")
     */
    private $featuredType;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project\Projects", inversedBy="projectFeatured")
	 * @ORM\JoinColumn(name="projectFeatured_id", referencedColumnName="id")
     */
    private $projectFeatured;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="productFeatured")
	 * @ORM\JoinColumn(name="productFeatured_id", referencedColumnName="id")
     */
    private $productFeatured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category\Categories", inversedBy="categoryFeatured")
	 * @ORM\JoinColumn(name="categoryFeatured_id", referencedColumnName="id")
     */
    private $categoryFeatured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorFeatured")
	 * @ORM\JoinColumn(name="vendorFeatured_id", referencedColumnName="id")
     */
    private $vendorFeatured;

    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

	/**
	 * @param $ordering
	 *
	 * @return Featured
	 */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
        return $this;
    }

    /**
     * @return integer
     */
    public function getOrdering()
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