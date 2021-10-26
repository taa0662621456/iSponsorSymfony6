<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Project\ProjectTag;
use App\Entity\Product\ProductTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TagsRepository
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectTag::class);
        parent::__construct($registry, ProductTag::class);
    }
}
