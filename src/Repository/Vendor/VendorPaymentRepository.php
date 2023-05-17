<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorPayment;
use App\RepositoryInterface\Vendor\VendorPaymentRepositoryInterface;
use App\Repository\EntityRepository;


/**
 * @method VendorPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorPayment[]    findAll()
 * @method VendorPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorPaymentRepository extends EntityRepository implements VendorPaymentRepositoryInterface
{
    public function __construct(\Doctrine\Persistence\ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorPayment::class);
    }

    // /**
    //  * @return VendorPayment[] Returns an array of VendorPayment objects
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
