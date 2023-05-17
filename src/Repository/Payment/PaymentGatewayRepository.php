<?php

namespace App\Repository\Payment;

use App\Entity\Payment\Payment;
use App\RepositoryInterface\Payment\PaymentGatewayRepositoryInterface;
use App\Repository\EntityRepository;
/**
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentGatewayRepository extends EntityRepository implements PaymentGatewayRepositoryInterface
{

}
