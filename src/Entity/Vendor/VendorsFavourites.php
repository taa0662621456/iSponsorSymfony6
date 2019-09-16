<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
	 * @var int
	 *
	 * @ORM\Column(name="vendor_favourites", type="integer", nullable=false, options={"default" : 0})
	 */
    private $vendorFavourites = 0;

    /**
     * @var DateTime
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
     * @var DateTime
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
        $this->createdOn = new DateTime();
        $this->lockedOn = new DateTime();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

	/**
	 * @return int
	 */
	public function getVendorFavourites(): int
	{
		return $this->vendorFavourites;
	}

	/**
	 * @param int $vendorFavourites
	 */
	public function setVendorFavourites(int $vendorFavourites): void
	{
		$this->vendorFavourites = $vendorFavourites;
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
	 * @return DateTime
	 */
	public function getCreatedOn(): DateTime
	{
		return $this->createdOn;
	}

	/**
	 * @param DateTime $createdOn
	 */
	public function setCreatedOn(DateTime $createdOn): void
	{
		$this->createdOn = $createdOn;
	}



    /**
     * @return DateTime
     */
    public function getLockedOn(): DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @param DateTime $lockedOn
     */
    public function setLockedOn(DateTime $lockedOn): void
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
