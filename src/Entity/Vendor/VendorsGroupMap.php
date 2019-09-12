<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_group_map")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class VendorsGroupMap
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="vendor_id", type="integer", nullable=false)
     */
    private $vendorId = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="group_id", type="integer", nullable=false, options={"comment"="Foreign Key to #__usergroups.id"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $groupId = 0;






    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    /**
     * @param int $vendorId
     */
    public function setVendorId(int $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }




}
