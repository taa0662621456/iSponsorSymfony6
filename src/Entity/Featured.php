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
     * @ORM\Column(name="id", type="integer")
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
     * @ORM\OneToOne(targetEntity="App\Entity\Project\Projects", inversedBy="featured", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false)
     */
    private $project;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="featured", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false)
     */
    private $product;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category\Categories", inversedBy="featured", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="featured", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false)
     */
    private $vendor;
    
    /**
     * Get id
     *
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
     * Set project
     *
     * @param Projects $project
     * @return Featured
     */
    public function setProject(Projects $project = null)
    {
        $this->project = $project;
        return $this;
    }
    /**
     * Get project
     *
     * @return Projects
     */
    public function getProject()
    {
        return $this->project;
    }   
    
    /**
     * Set product
     *
     * @param Products $product
     * @return Featured
     */
    public function setProduct(Products $product = null)
    {
        $this->product = $product;
        return $this;
    }
    /**
     * Get product
     *
     * @return Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set category
     *
     * @param Categories $category
     * @return Featured
     */
    public function setCategory(Categories $category = null)
    {
        $this->category = $category;
        return $this;
    }
    /**
     * Get category
     *
     * @return Categories
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set vendor
     *
     * @param Vendors $vendor
     * @return Featured
     */
    public function setVendor(Vendors $vendor = null)
    {
        $this->vendor = $vendor;
        return $this;
    }
    /**
     * Get vendor
     *
     * @return Vendors
     */
    public function getVendor()
    {
        return $this->vendor;
    }
}