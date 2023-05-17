<?php

namespace App\Repository\Currency;

use App\Entity\Currency\Currency;
use App\Entity\Currency\CurrencyExchange;
use App\EntityInterface\Currency\CurrencyRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends EntityRepository implements CurrencyRepositoryInterface
{

}
