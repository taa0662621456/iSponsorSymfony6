<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Featured;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
* @method Featured|null find($id, $lockMode = null, $lockVersion = null)
* @method Featured|null findOneBy(array $criteria, array $orderBy = null)
* @method Featured[]    findAll()
* @method Featured[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class FeaturedRepository extends ServiceEntityRepository
{
    /**
     * ProjectsRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Featured::class);
    }

}