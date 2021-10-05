<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Project\ProjectsTags;
use App\Entity\Product\ProductsTags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TagsRepository
 */
class TagsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectsTags::class);
        parent::__construct($registry, ProductsTags::class);
    }
}