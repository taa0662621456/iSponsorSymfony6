<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductStorage;
use Doctrine\ORM\EntityRepository;

/**
 * @method ProductStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductStorage[]    findAll()
 * @method ProductStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductPaymentRepository extends EntityRepository
{

}
