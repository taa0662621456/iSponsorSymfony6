<?php

namespace App\Repository\Project;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Project\ProjectPlatformReward;

/**
 * @method ProjectPlatformReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectPlatformReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectPlatformReward[]    findAll()
 * @method ProjectPlatformReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectPlatformRewardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectPlatformReward::class);
    }
}
