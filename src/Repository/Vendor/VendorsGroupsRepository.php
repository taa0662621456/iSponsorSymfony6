<?php


namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorsGroups;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VendorsGroups|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorsGroups|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorsGroups[]    findAll()
 * @method VendorsGroups[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorsGroupsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorsGroups::class);
    }

    // /**
    //  * @return VendorsGroups[] Returns an array of VendorsGroups objects
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
    public function findOneBySomeField($value): ?VendorsGroups
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
