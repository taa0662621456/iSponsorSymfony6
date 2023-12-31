<?php

namespace App\Repository\Currency;

use App\Repository\EntityRepository;
use App\Entity\Currency\CurrencyExchange;
use App\RepositoryInterface\Currency\CurrencyExchangeRepositoryInterface;

/**
 * @method CurrencyExchange|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyExchange|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyExchange[]    findAll()
 * @method CurrencyExchange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyExchangeRepository extends EntityRepository implements CurrencyExchangeRepositoryInterface
{
}
