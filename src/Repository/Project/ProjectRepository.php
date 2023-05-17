<?php


namespace App\Repository\Project;

use App\Entity\Project\Project;
use App\RepositoryInterface\Project\ProjectRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\InputBag;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends EntityRepository implements ProjectRepositoryInterface
{

    public function findBySearchQuery(float|InputBag|bool|int|string|null $query, float|InputBag|bool|int|string|null $limit)
    {
        //TODO:
    }
}
