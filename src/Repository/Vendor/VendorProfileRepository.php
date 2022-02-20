<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VendorProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorProfile[]    findAll()
 * @method VendorProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorProfile::class);
    }


    /**
     * @param $vendorId
     */
    public function findActiveVendorById($vendorId): VendorProfile
    {
        return $this->findOneBy([
            'id' => (int) $vendorId,
            'iaActive' => true
        ]);
    }

    public function findActiveVendorByApiToken($vendorId): VendorProfile
    {
        return $this->findOneBy([
            'apiToken' => $vendorId,
            'isActive' => true
        ]);
    }

    public function setIsActive(bool $true)
    {
    }


}
