<?php


namespace App\Repository\Project;

use App\Entity\Project\ProjectEnGb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectEnGb|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectEnGb|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectEnGb[]    findAll()
 * @method ProjectEnGb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectEnGbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectEnGb::class);
    }

    // /**
    //  * @return ProjectsEnGb[] Returns an array of ProjectsEnGb objects
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
    public function findOneBySomeField($value): ?ProjectsEnGb
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
