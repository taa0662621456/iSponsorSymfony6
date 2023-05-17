<?php

namespace App\Repository\Currency;

use App\Entity\Coupon\Coupon;
use App\Entity\Currency\Currency;
use App\RepositoryInterface\Address\CurrencyEnRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyEnRepository extends EntityRepository implements CurrencyEnRepositoryInterface
{

}
