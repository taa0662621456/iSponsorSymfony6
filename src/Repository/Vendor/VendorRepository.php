<?php


namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorFavourite;
use App\Entity\Vendor\VendorIban;
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
     * @return VendorIban|Vendor|VendorDocument|VendorEnGb|VendorFavourite|null
     */
    public function findActiveVendorById($vendorId): VendorIban|Vendor|VendorDocument|VendorEnGb|VendorFavourite|null
    {
        return $this->findOneBy([
            'id' => (int) $vendorId,
            'iaActive' => true
        ]);
    }

    public function findActiveVendorByApiToken($vendorId): VendorIban|Vendor|VendorDocument|VendorEnGb|VendorFavourite|null
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
