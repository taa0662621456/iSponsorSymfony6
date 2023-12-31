<?php

namespace App\Repository\Vendor;

use App\Repository\EntityRepository;
use App\Entity\Vendor\VendorShipment;
use App\RepositoryInterface\Vendor\VendorShipmentRepositoryInterface;

/**
 * @method VendorShipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorShipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorShipment[]    findAll()
 * @method VendorShipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorShipmentRepository extends EntityRepository implements VendorShipmentRepositoryInterface
{
    public function __construct(\Doctrine\Persistence\ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorShipment::class);
    }

    // /**
    //  * @return VendorShipment[] Returns an array of VendorShipment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
