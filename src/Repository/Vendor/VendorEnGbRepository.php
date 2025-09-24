<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorEnUS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VendorEnUS|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorEnUS|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorEnUS[]    findAll()
 * @method VendorEnUS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorEnGbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorEnUS::class);
    }

    public function getMail()
    {
        // TODO: get Vendor by email

    }

    // /**
    //  * @return VendorsEnGb[] Returns an array of VendorsEnGb objects
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


    /**
     * @throws NonUniqueResultException
     */
    public function findOneBySomeField($value): ?VendorEnUS
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}