<?php
namespace App\Repository\Project;

use App\Entity\Project\ProjectTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectTag[]    findAll()
 * @method ProjectTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectTag::class);
    }

}
