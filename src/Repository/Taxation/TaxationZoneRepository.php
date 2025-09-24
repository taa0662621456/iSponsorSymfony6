<?php

namespace App\Repository\Taxation;

use App\Entity\Taxation\Taxation;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Taxation\TaxationZoneRepositoryInterface;

/**
 * @method Taxation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taxation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taxation[]    findAll()
 * @method Taxation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxationZoneRepository extends EntityRepository implements TaxationZoneRepositoryInterface
{
}