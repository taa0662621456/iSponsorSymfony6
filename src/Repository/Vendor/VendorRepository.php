<?php
declare(strict_types=1);

namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vendor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendor[]    findAll()
 * @method Vendor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vendor::class);
    }

    //TODO: непойму, зачем писать дополнительные методы, если есть аналогичные встроенные в фреймворк

    /**
     * @param $vendorId
     * @return \App\Entity\Vendor\Vendor|\App\Entity\Vendor\VendorDocument|\App\Entity\Vendor\VendorEnGb|\App\Entity\Vendor\VendorFavourite|\App\Entity\Vendor\VendorIban|null
     */
    public function findActiveVendorById($vendorId): \App\Entity\Vendor\VendorIban|Vendor|\App\Entity\Vendor\VendorDocument|\App\Entity\Vendor\VendorEnGb|\App\Entity\Vendor\VendorFavourite|null
    {
        return $this->findOneBy([
            'id' => (int) $vendorId,
            'iaActive' => true
        ]);
    }

    public function findActiveVendorByApiToken($vendorId): \App\Entity\Vendor\VendorIban|Vendor|\App\Entity\Vendor\VendorDocument|\App\Entity\Vendor\VendorEnGb|\App\Entity\Vendor\VendorFavourite|null
    {
        return $this->findOneBy([
            'apiToken' => $vendorId,
            'isActive' => true
        ]);
    }


}
