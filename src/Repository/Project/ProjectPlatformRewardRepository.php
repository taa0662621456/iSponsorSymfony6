<?php

namespace App\Repository\Project;

use App\Repository\EntityRepository;
use App\Entity\Project\ProjectPlatformReward;
use App\RepositoryInterface\Project\ProjectPlatformRewardRepositoryInterface;

/**
 * @method ProjectPlatformReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectPlatformReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectPlatformReward[]    findAll()
 * @method ProjectPlatformReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectPlatformRewardRepository extends EntityRepository implements ProjectPlatformRewardRepositoryInterface
{
}