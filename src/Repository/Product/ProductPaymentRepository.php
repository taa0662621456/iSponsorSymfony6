<?php

namespace App\Repository\Product;

use App\Repository\EntityRepository;
use App\Entity\Product\ProductStorage;
use App\RepositoryInterface\Product\ProductPaymentRepositoryInterface;

/**
 * @method ProductStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductStorage[]    findAll()
 * @method ProductStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductPaymentRepository extends EntityRepository implements ProductPaymentRepositoryInterface
{
}
