<?php

namespace App\Repository\Currency;

use App\Entity\Currency\Currency;
use App\RepositoryInterface\Currency\CurrencyTypeRepositoryInterface;
use App\Form\Currency\CurrencyType;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrencyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyType[]    findAll()
 * @method CurrencyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyTypeRepository extends EntityRepository implements CurrencyTypeRepositoryInterface
{

}
