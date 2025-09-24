<?php

namespace App\Repository\Exchange;

use App\Entity\Exchange\Exchange;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Exchange\ExchangeRateRepositoryInterface;

/**
 * @method Exchange|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exchange|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exchange[]    findAll()
 * @method Exchange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExchangeRateRepository extends EntityRepository implements ExchangeRateRepositoryInterface
{
}