<?php

namespace App\Repository\Project;

use App\Entity\Project\ProjectsOptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjectsOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectsOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectsOptions[]    findAll()
 * @method ProjectsOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsOptionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
		parent::__construct($registry, ProjectsOptions::class);
    }

    // /**
    //  * @return ProjectsOptions[] Returns an array of ProjectsOptions objects
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
    public function findOneBySomeField($value): ?ProjectsOptions
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
