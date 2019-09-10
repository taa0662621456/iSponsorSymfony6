<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Project\Projects;
use App\Entity\Project\ProjectsTags;
use App\Entity\Vendor\Vendors;
use App\Pagination\Paginator;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Exception;
use phpDocumentor\Reflection\Project;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Projects|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projects|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projects[]    findAll()
 * @method Projects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsRepository extends ServiceEntityRepository
{
    /**
     * ProjectsRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Projects::class);
    }




}
