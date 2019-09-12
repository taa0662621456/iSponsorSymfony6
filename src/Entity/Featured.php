<?php
declare(strict_types=1);

namespace App\Entity;

use App\Entity\Category\Categories;
use App\Entity\Product\Products;
use App\Entity\Project\Projects;
use App\Entity\Vendor\Vendors;
use Doctrine\ORM\Mapping as ORM;


    /**
     * Featured
     *
     * @ORM\Table(name="featured")
     * @ORM\Entity(repositoryClass="App\Repository\FeaturedRepository")
     */
class Featured
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="order", type="integer")
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project\Projects", inversedBy="projectFeatured")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
    private $projectFeatured;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="productFeatured")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
    private $productFeatured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category\Categories", inversedBy="categoryFeatured")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
    private $categoryFeatured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorFeatured")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
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
     * Set order
     *
     * @param integer $order
     * @return Featured
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }
    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

	/**
	 * @param Projects|null $projectFeatured
	 *
	 * @return Featured
	 */
    public function setProjectFeatured(Projects $projectFeatured = null)
    {
        $this->projectFeatured = $projectFeatured;
        return $this;
    }

    /**
     * @return Projects
     */
    public function getProjectFeatured()
    {
        return $this->projectFeatured;
    }

	/**
	 * @param Products|null $productFeatured
	 *
	 * @return Featured
	 */
    public function setProductFeatured(Products $productFeatured = null)
    {
        $this->productFeatured = $productFeatured;
        return $this;
    }
    /**
     * @return Products
     */
    public function getProductFeatured()
    {
        return $this->productFeatured;
    }

    /**
     * @param Categories $categoryFeatured
     * @return Featured
     */
    public function setCategoryFeatured(Categories $categoryFeatured = null)
    {
        $this->categoryFeatured = $categoryFeatured;
        return $this;
    }

    /**
     * @return Categories
     */
    public function getCategoryFeatured()
    {
        return $this->categoryFeatured;
    }

	/**
	 * @param Vendors|null $vendorFeatured
	 *
	 * @return Featured
	 */
    public function setVendorFeatured(Vendors $vendorFeatured = null)
    {
        $this->vendorFeatured = $vendorFeatured;
        return $this;
    }
    /**
     * @return Vendors
     */
    public function getVendorFeatured()
    {
        return $this->vendorFeatured;
    }
}