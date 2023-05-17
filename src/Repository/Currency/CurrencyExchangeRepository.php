<?php

namespace App\Repository\Currency;

use App\Entity\Coupon\Coupon;
use App\Entity\Currency\Currency;
use App\Entity\Currency\CurrencyExchange;
use App\RepositoryInterface\Currency\CurrencyExchangeRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrencyExchange|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyExchange|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyExchange[]    findAll()
 * @method CurrencyExchange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyExchangeRepository extends EntityRepository implements CurrencyExchangeRepositoryInterface
{
}
