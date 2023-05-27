<?php
namespace App\Repository\Project;

use App\Entity\Project\ProjectTag;
use App\RepositoryInterface\Project\ProjectTagRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectTag[]    findAll()
 * @method ProjectTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectTagRepository extends EntityRepository implements ProjectTagRepositoryInterface
{

}
