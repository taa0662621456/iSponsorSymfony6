<?php

namespace App\Repository\Taxation;

use App\Entity\Taxation\Taxation;
use App\RepositoryInterface\Taxation\TaxationRateValueRepositoryInterface;
use App\Repository\EntityRepository;
/**
 * @method Taxation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taxation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taxation[]    findAll()
 * @method Taxation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxationRateValueRepository extends EntityRepository implements TaxationRateValueRepositoryInterface
{

}