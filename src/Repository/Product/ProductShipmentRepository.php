<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductShipment;
use App\RepositoryInterface\Product\ProductShipmentRepositoryInterface;
use App\Repository\EntityRepository;


/**
 * @method ProductShipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductShipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductShipment[]    findAll()
 * @method ProductShipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductShipmentRepository extends EntityRepository implements ProductShipmentRepositoryInterface
{

}
