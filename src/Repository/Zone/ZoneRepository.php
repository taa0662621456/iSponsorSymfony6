<?php

namespace App\Repository\Zone;

use App\Entity\Zone\Zone;
use App\Repository\EntityRepository;
use App\EntityInterface\Zone\ZoneRepositoryInterface;

/**
 * @method Zone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zone[]    findAll()
 * @method Zone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneRepository extends EntityRepository implements ZoneRepositoryInterface
{
}