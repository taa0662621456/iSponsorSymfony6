<?php
declare(strict_types=1);

namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsFavourites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vendors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendors[]    findAll()
 * @method Vendors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vendors::class);
    }

    //TODO: непойму, зачем писать дополнительные методы, если есть аналогичные встроенные в фреймворк

    /**
     * @param $vendorId
     * @param string $id
     */
    public function findActiveVendorById($vendorId)
    {
        return $this->findOneBy([
            'id' => (int) $vendorId,
            'iaActive' => true
        ]);
    }

    public function findActiveVendorByApiToken($vendorId)
    {
        return $this->findOneBy([
            'apiToken' => $vendorId,
            'isActive' => true
        ]);
    }


}
