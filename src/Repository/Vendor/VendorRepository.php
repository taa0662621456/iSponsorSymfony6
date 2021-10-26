<?php
declare(strict_types=1);

namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorFavourite;
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
