<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductPayment;
use Doctrine\ORM\EntityRepository;

/**
 * @method ProductPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductPayment[]    findAll()
 * @method ProductPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductPaymentRepository extends EntityRepository
{

}