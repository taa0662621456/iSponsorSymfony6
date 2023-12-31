<?php

namespace App\Repository\Type;

use App\Entity\Project\ProjectType;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\InputBag;
use App\RepositoryInterface\Type\TypeRepositoryInterface;

/**
 * @method ProjectType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectType[]    findAll()
 * @method ProjectType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends EntityRepository implements TypeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectType::class);
    }

    public function findBySearchQuery(float|InputBag|bool|int|string|null $query, float|InputBag|bool|int|string|null $limit)
    {
        // TODO:
    }
}
