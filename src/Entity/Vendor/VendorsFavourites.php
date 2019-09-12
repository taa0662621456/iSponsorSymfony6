<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * VendorsFavourites
 *
 * @ORM\Table(name="vendors_favourites")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 */
class VendorsFavourites
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorFavourites")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $vendorFavourites;

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
     * VendorsFavorites constructor.
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
     * @param Vendors $vendorFavourite
     * @return VendorsFavourites
     */
    public function setVendorFavourites(Vendors $vendorFavourite = null): VendorsFavourites
    {
        $this->vendorFavourites = $vendorFavourite;

        return $this;
    }

    /**
     * @return Vendors
     */
    public function getVendorFavourites(): Vendors
    {
        return $this->vendorFavourites;
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
    public function setCreatedBy(?string $createdBy): void
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
