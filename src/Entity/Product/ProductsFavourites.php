<?php
declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\Product\Products;
use App\Entity\Vendors;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * ProductsFavourites
 *
 * @ORM\Table(name="products_favourites")
 * @ORM\Entity(repositoryClass="ProductsFavouritesRepository")
 */
class ProductsFavourites
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Products", inversedBy="favourites")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = 0;







    /**
     * ProductsFavorites constructor.
     */
    public function __construct()
    {
        $this->createdOn = new \DateTime();
        $this->modifiedOn = new \DateTime();
        $this->lockedOn = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Products $product
     * @return ProductsFavourites
     */
    public function setProduct(Products $product = null): ProductsFavourites
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Products
     */
    public function getProduct(): Products
    {
        return $this->product;
    }


    /**
     * @return integer
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     * @return void
     */
    public function setCreatedBy(string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return \DateTime
     */

    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }

    /**
     * @ORM\PrePersist
     * @return void
     * @throws Exception
     */
    public function setCreatedOn(): void
    {
        $this->createdOn = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getLockedOn(): \DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @param DateTime $lockedOn
     */
    public function setLockedOn(\DateTime $lockedOn): void
    {
        $this->lockedOn = $lockedOn;
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }


}
