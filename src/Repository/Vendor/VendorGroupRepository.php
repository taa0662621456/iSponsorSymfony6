<?php


namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorGroup;
use App\RepositoryInterface\Vendor\VendorGroupRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VendorGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorGroup[]    findAll()
 * @method VendorGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorGroupRepository extends EntityRepository implements VendorGroupRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorGroup::class);
    }

    // /**
    //  * @return VendorGroup[] Returns an array of VendorGroup objects
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
    public function findOneBySomeField($value): ?VendorGroup
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
