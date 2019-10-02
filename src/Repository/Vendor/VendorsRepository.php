<?php
declare(strict_types=1);

namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vendors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendors[]    findAll()
 * @method Vendors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vendors::class);
    }

    // /**
    //  * @return Vendors[] Returns an array of Vendors objects
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

    /*
    public function findOneBySomeField($value): ?Vendors
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
