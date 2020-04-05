<?php
declare(strict_types=1);
namespace App\Repository;

use App\Entity\PlatformLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlatformLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatformLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatformLang[]    findAll()
 * @method PlatformLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformLangRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatformLang::class);
    }

    // /**
    //  * @return PlatformLang[] Returns an array of PlatformLang objects
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
    public function findOneBySomeField($value): ?PlatformLang
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
