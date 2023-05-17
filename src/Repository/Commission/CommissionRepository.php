<?php

namespace App\Repository\Commission;

use App\Entity\Commission\Commission;
use App\RepositoryInterface\Commission\CommissionRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method Commission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commission[]    findAll()
 * @method Commission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommissionRepository extends EntityRepository implements CommissionRepositoryInterface
{

}
