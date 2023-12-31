<?php

namespace App\Repository\Order;

use App\Entity\Order\OrderStorage;
use App\RepositoryInterface\Order\OrderBillingRepositoryInterface;
use App\Repository\EntityRepository;
/**
 * @method OrderStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStorage[]    findAll()
 * @method OrderStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderBillingRepository extends EntityRepository implements OrderBillingRepositoryInterface
{

}