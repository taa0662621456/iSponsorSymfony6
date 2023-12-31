<?php

namespace App\Repository\Role;

use App\Entity\Role\Role;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Role\RoleRepositoryInterface;

/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends EntityRepository implements RoleRepositoryInterface
{
}
