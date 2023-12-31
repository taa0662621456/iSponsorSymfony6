<?php

namespace App\Repository\Tag;

use App\Entity\Product\ProductTag;
use App\Entity\Project\ProjectTag;
use App\Entity\Tag\Tag;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\RepositoryInterface\Tag\TagRepositoryInterface;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends EntityRepository implements TagRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectTag::class);
        parent::__construct($registry, ProductTag::class);
    }
}
