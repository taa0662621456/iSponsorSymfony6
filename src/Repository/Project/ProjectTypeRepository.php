<?php

namespace App\Repository\Project;

use App\Entity\Project\ProjectType;
use App\Repository\EntityRepository;
use Symfony\Component\HttpFoundation\InputBag;
use App\RepositoryInterface\Project\ProjectTypeRepositoryInterface;

/**
 * @method ProjectType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectType[]    findAll()
 * @method ProjectType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectTypeRepository extends EntityRepository implements ProjectTypeRepositoryInterface
{
    public function findBySearchQuery(float|InputBag|bool|int|string|null $query, float|InputBag|bool|int|string|null $limit)
    {
        // TODO:
    }
}
